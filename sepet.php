<?php

	header('content-type: text/html; charset=utf8');
	ob_start();

	/*ürünlerim*/
	$urunler = array(1,2,3,4,5);

	if ( isset($_GET['sepetim']) ) {

		if ( count($_COOKIE['urun']) > 0) {

			foreach ($_COOKIE['urun'] as $key => $value) {
				echo '<div style="border: 1px solid #ddd; padding:10px; margin-bottom: 10px;">
					<h2>Ürün'.$key.'</h2>
					<p>burası ürün açıklaması</p>
					<a href="?cikart='.$key.'">[sepeten çıkar]</a>
				</div>';
			}

		} else {
			echo "Sepetinizde ürün bulunmamaktadır.";
		}
		
	} else {

		/*sepette kaç tane ürün var?*/
		if ( isset($_COOKIE['urun']) ) {
			echo 'Sepetinizde şuan ('.count($_COOKIE['urun']).') bulunmamaktadır! <a href="?sepetim=true">[Sepeti Göster]</a> / <a href="?bosalt=true">[Sepeti Boşalt]</a>';
		} else {
			echo "Sepetinizde ürün bulunmamaktadır";
		}

		/*ürünleri listele*/
		foreach ($urunler as $urun) {
			echo '<div style="border: 1px solid #ddd; padding:10px; margin-bottom: 10px;">
				<h2>Ürün'.$urun.'</h2>
				<p>burası ürün açıklaması</p>
				'.(isset($_COOKIE['urun'][$urun]) ? '<a href="?cikart='.$urun.'">[sepeten çıkar]</a>' : '<a href="?ekle='.$urun.'">[sepete ekle]</a>').'
			</div>';
		}

	}

	/*ürün ekle*/
	if ( isset($_GET['ekle']) ) {
		$id = $_GET['ekle'];
		setcookie('urun['.$id.']', $id, time() + 86400);
		header("Location:".$_SERVER['HTTP_REFERER']);
	}

	/*ürün boşalt*/
	if ( isset($_GET['bosalt']) ) {
		foreach ($_COOKIE['urun'] as $key => $value) {
			setcookie('urun['.$key.']', $key, time() - 86400);
		}
		header("Location:".$_SERVER['HTTP_REFERER']);
	}
	
	/*ürün çıkart*/
	if ( isset($_GET['cikart']) ) {
		setcookie('urun['.$_GET['cikart'].']', $_GET['cikart'], time() - 86400);
	}


?>