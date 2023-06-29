<?php
// addtocart.php 程式功能: 
//  1. 購物車是利用$_SESSION變數來模擬，$_SESSION變數位於Server端，對於
//     不同的使用者將保有不同的$_SESSION變數。
//  2. 將瀏覽器送來的三項商品資訊，包括商品編號(bookID), 商品名稱(title), 單價(price)
//     取出，與購買數量(預設為1) 分別存入變數 $_SESSION['Cart'],  
//     $_SESSION['Name'], $_SESSION['Name'], $_SESSION['Quantity']  
//     這四個變數的內容分別為一個陣列，即存入的四份資料會分別成為四個陣列的一個元素。
//  3. 存入資料時會判斷陣列內是否已經有此項商品，如果已經購買過，則此次『加入購物車』
//     表示要加買，則將該項商品的數量加一。
//     
//  注意：$_SESSION為陣列，$_SESSION['Cart']為$_SESSION的元素，
//        它本身是一個一維陣列。
	session_start();
// 判斷是否有$_SESSION['Cart']變數，如果有，表示第二次(或之後)按下『加入購物車』
	
	if(isset($_SESSION['Cart'])){  
       $res1 = indexOf($_POST['bookID'], $_SESSION['Cart']) ;		
       if ($res1 != -1) {    // 購物車內已經有此項商品
           $_SESSION['Quantity'][$res1] += 1;      //商品數量加 1 		
	   } else {  // 購物車內無此商品，第一次購買
	   	   // 將$_POST['bookID']加入陣列 $_SESSION['Cart']內，成為它的一個元素
    	   $_SESSION['Cart'][] = $_POST['bookID']; //商品編號
    	   
	   	   // 將$_POST['title']加入陣列 $_SESSION['Name']內，成為它的一個元素    	   
	       $_SESSION['Name'][] = $_POST['title'];  //商品名稱
	       
	       $_SESSION['Price'][] = $_POST['price']; //單價
	       $_SESSION['Quantity'][] = 1;			   //商品數量設為1
	   }
	} else { // 表示第一次按下『加入購物車』
		$_SESSION['Cart'][] = $_POST['bookID'];	//商品編號
	    $_SESSION['Name'][] = $_POST['title'];	//商品名稱
	    $_SESSION['Price'][] = $_POST['price'];	//單價
	    $_SESSION['Quantity'][] = 1;	
	}
	// 下列敘述會送出回應,請瀏覽器對showcart.php發出請求，要求該項資源，
	// 即使用者的螢幕將會出現showcart.php的內容
    header("Location:showcart.php");  
	// 搜尋$needle是否存在於陣列$haystack內，如果存在傳回該$needle在陣列內的
	// 註標(0表示第一個)，否則傳回 -1。
	function indexOf($needle, $haystack) {
        foreach ($haystack as $i => $value) { 
                if ($value == $needle) {
                    return $i;             
                }
        }
        return -1;
     }
?>