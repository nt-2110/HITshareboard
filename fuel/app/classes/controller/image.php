<?php

class Controller_Image extends Controller_Template
{

	public function action_upload()
	{
		if(Input::method('POST')){
			$config = array(
				'path' => DOCROOT.DS.'files',
				'randomize' => true,
			);
			Upload::process($config);
			if(Upload::is_valid()){
				$files = Upload::get_files();
				foreach($files as $file){
					Model_Bulletin::add($file);
				}
			}
		}
		Session::set_flash('success', 1);
		Response::redirect('/top/upload');
	}

	public function action_image($id = null)
	{
		$pic = Model_Bulletin::find($id);
		$images = array(
			'png' => 'image/png',
			'jpg' => 'image/jpeg',
			'jpeg' => 'image/jpeg',
			'gif' => 'image/gif',
		);
		$headers = array(
			'Content-type' => $images[$pic->ext],
		);
		return Response::forge($pic->data, 200, $headers);
	}

	public function action_thumbnail($id = null)
	{
		$pic = Model_Bulletin::find($id);
		$images = array(
			'png' => 'image/png',
			'jpg' => 'image/jpeg',
			'jpeg' => 'image/jpeg',
			'gif' => 'image/gif',
		);
		$headers = array(
			'Content-type' => $images[$pic->ext],
		);
		return Response::forge($pic->thumbnail, 200, $headers);
	}

	public function action_check()
	{
		// 写真のExifからデータを取得(規定名として、download.jpegにしている)
//		$exif = exif_read_data('download.jpeg');
		$exif = exif_read_data('/home/worker/Downloads/image.jpeg');

		// Exifが不正でないかチェック
		$ret = $this->checkCorrectExif( $exif);
		if( !$ret) die("エラー : 処理に必要なExifデータが一部または全て存在しません。");

		//時間の確認
		$ret = $this->checkTakeTime( $exif);
		if( !$ret) die("エラー : 画像を撮ってから5分以上経過してます");

		//緯度経度の確認
		$ret = $this->checkAddingGPSTag( $exif);
		if( !$ret) die("エラー : 写真のGPSデータが不正");
		$ret = $this->decisionBoardFromPos( $exif); // 結果は一番近い「掲示板名」

		//デバッグ(表示)
		echo "一番近い掲示板は -> ";
		echo $ret;// インデックスに応じて、場所を取得
	}

	/* *****************
	 * 以下、作った関数
	 * ***************** */

	public function checkCorrectExif( $exif)
	{
		// Exif内に DateTime が存在しなければ
		if( !isset($exif['DateTime']))
		{
			return false;
		}

		// Exif内に 位置情報 が存在しなければ
		if( !isset($exif['GPSLatitude']) && !isset($exif['GPSLongitude']))
		{
			return false;
		}

		// Exif内に 東経か西経、北緯か南緯かの判別データが存在しなければ
		if( !isset($exif['GPSLatitudeRef']) && !isset($exif['GPSLongitudeRef']))
		{
			return false;
		}
		return true;
	}

	//時間内にに撮った画像であれば、認可する
	public function checkTakeTime( $exif)
	{
		$nowTime = time();
		$acceptTime = 300;// デフォルト300秒(=5分)

		if( ( $nowTime - $acceptTime < $exif['DateTime']) && ( $exif['DateTime'] < $nowTime + $acceptTime))
		{
			return true;
		}

		return false;
	}

	//緯度経度から、所定の掲示板位置を割り出す
	public function decisionBoardFromPos( $exif)
	{

		// 掲示板情報の配列情報(将来的に XML or Json から取得すると思う)
		$boardArray = array( "新1号館-4階", "新4号館-4階", "Nexus21-4階", "中奥家(テスト)");
		$latitudeArray = array(
			56.00425,
			56.003527777778,
			56.003305555556,
			56.015213888889
		);// 緯線
		$longitudeArray = array(
			152.01027777778,
			152.00955555556,
			152.01069444444,
			165.00461111111
		);// 経度

		//写真から経度情報の読み取り
		$picGPSLat = $exif['GPSLatitude'];
		$picGPSLong = $exif['GPSLongitude'];
		$picLatitude    = $this->calcLatLongAsDeg( $picGPSLat[0], $picGPSLat[1], $picGPSLat[2]);// 緯度
		$picLongitude   = $this->calcLatLongAsDeg( $picGPSLong[0], $picGPSLong[1], $picGPSLong[2]);//経度

		// 経度・緯度配列データより、最短掲示板を割り出す
		$i = 0;
		$minDist = 9999999999;
		$index = -1;
		foreach ( $latitudeArray as $a)
		{
			$distance = sqrt( pow( $latitudeArray[$i] - $picLatitude , 2) + pow( $longitudeArray[$i] - $picLongitude, 2));// 掲示板と撮影場所の距離を取得
			if( $distance < $minDist)// 最短掲示板が見つかったら
			{
				$index = $i;// そのインデックスを格納
			}

			$i++;
		}
		return $boardArray[$index];
	}

	//Exifデータが付与されているか、確認
	public function checkAddingGPSTag( $exif)
	{
		// GPSのデータが北緯と東経となっているか?
		if( $exif['GPSLatitudeRef'] == 'N' && $exif['GPSLongitudeRef'] == 'E')
		{
			return true;
		}

		return false;
	}

	//緯度経度から、「地球の角座標」を算出
	public function calcLatLongAsDeg( $degree, $minute, $second)
	{
		$second = $second / 100;
		return $degree + $minute + $second/3600;
	}

	//写真の全Exifの表示
	public function putExifData( $exif)
	{
		foreach ($exif as $key=>$value)
		{
			echo $key."=";
			print_r($value);
			echo "<hr>";
		}

		return;
	}

}
