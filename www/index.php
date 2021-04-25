<?php
function ValidateEmail($email)
{
   $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
   return preg_match($pattern, $email);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['formid']) && $_POST['formid'] == 'indexform3')
{
   $mailto = 'bonecrusher600.ru@gmail.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'Заявка на консультацию BoneCrusher 610!';
   $message = 'Информация о заказе:';
   $success_url = './prn_v.php';
   $error_url = '';
   $error = '';
   $eol = "\n";
   $boundary = md5(uniqid(time()));
   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'MIME-Version: 1.0'.$eol;
   $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
   $header .= 'X-Mailer: PHP v'.phpversion().$eol;
   if (!ValidateEmail($mailfrom))
   {
      $error .= "The specified email address is invalid!\n<br>";
   }
   if (!empty($error))
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $error, $errorcode);
      echo $errorcode;
      exit;
   }
   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha_code", "recaptcha_challenge_field", "recaptcha_response_field", "g-recaptcha-response");
   $message .= $eol;
   $message .= "IP Address : ";
   $message .= $_SERVER['REMOTE_ADDR'];
   $message .= $eol;
   $logdata = '';
   foreach ($_POST as $key => $value)
   {
      if (!in_array(strtolower($key), $internalfields))
      {
         if (!is_array($value))
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
         }
         else
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
         }
      }
   }
   $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
   $body .= '--'.$boundary.$eol;
   $body .= 'Content-Type: text/plain; charset=UTF-8'.$eol;
   $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
   $body .= $eol.stripslashes($message).$eol;
   if (!empty($_FILES))
   {
       foreach ($_FILES as $key => $value)
       {
          if ($_FILES[$key]['error'] == 0)
          {
             $body .= '--'.$boundary.$eol;
             $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
             $body .= 'Content-Transfer-Encoding: base64'.$eol;
             $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
             $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
          }
      }
   }
   $body .= '--'.$boundary.'--'.$eol;
   if ($mailto != '')
   {
      mail($mailto, $subject, $body, $header);
   }
   header('Location: '.$success_url);
   exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Измельчитель пищевых отходов Bone Crusher 610 (BC 610) | Описание, стоимость, монтаж, сервис, гарантия, отзывы</title>
<meta name="description" content="Измельчитель пищевых отходов устраняет источники бактерий и насекомых, а также он очень удобен в обращении.">
<meta name="keywords" content="Измельчитель, измельчитель пищевые отходы, BoneCrusher, bone crusher, bonecrusher 610, измельчитель купить, измельчитель отходов Bone Crusher, bone crusher 610">
<link href="favicon!.ico" rel="shortcut icon" type="image/x-icon">
<link href="index.css" rel="stylesheet">
<script src="jquery-1.12.4.min.js"></script>
<script src="magnificpopup/jquery.magnific-popup.min.js"></script>
<link rel="stylesheet" href="magnificpopup/magnific-popup.css">

<link rel="stylesheet" href="dop-css.css">

<script src="fancybox/jquery.easing-1.3.pack.js"></script>
<link rel="stylesheet" href="fancybox/jquery.fancybox-1.3.4.css">
<script src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script src="fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script>
   function displaylightbox(url, options)
   {
      options.padding = 0;
      options.autoScale = true;
      options.href = url;
      options.type = 'iframe';
      $.fancybox(options);
   }
</script>
<script>
   $(document).ready(function()
   {
      $("a[data-rel='indexSlideShow1']").attr('rel', 'indexSlideShow1');
      $("#indexSlideShow1").magnificPopup({delegate:'a', type:'image', gallery: {enabled: true, navigateByImgClick: true}});
   });
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async=""
src="https://www.googletagmanager.com/gtag/js?id=UA-111361183-1"></script>
<script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-111361183-1');
</script>
<meta property="og:image" content="./123.jpg">
</head>
<body>
   <div id="container">
   </div>
   <div id="indexLayer2" style="position:absolute;text-align:center;left:0%;top:91px;width:100%;height:653px;z-index:122;">
      <div id="indexLayer2_Container" style="width:970px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
         <div id="wb_indexShape3" style="position:absolute;left:11px;top:451px;width:252px;height:65px;z-index:0;">
            <a href="javascript:displaylightbox('./zakaz.php',{scrolling:'no'})" target="_self"><img src="images/img0004.png" id="indexShape3" alt="" style="width:252px;height:65px;"></a></div>
         <div id="wb_indexShape5" style="position:absolute;left:12px;top:255px;width:518px;height:60px;z-index:1;">
            <img src="images/img0005.png" id="indexShape5" alt="" style="width:518px;height:60px;"></div>
         <div id="wb_indexText1" style="position:absolute;left:10px;top:106px;width:932px;height:130px;z-index:2;">
            <span style="color:#303030;font-family:'Proxima Nova Th';font-size:53px;">Измельчитель пищевых<br>отходов Bonecrusher 610</span></div>
         <div id="wb_indexText2" style="position:absolute;left:43px;top:271px;width:503px;height:29px;z-index:3;">
            <span style="color:#FFFFFF;font-family:'Proxima Nova Rg';font-size:24px;letter-spacing:0.07px;">Чистота и экологичность на Вашей кухне</span></div>
         <div id="wb_indexShape6" style="position:absolute;left:603px;top:334px;width:150px;height:150px;z-index:4;">
            <img src="images/img0006.png" id="indexShape6" alt="" style="width:150px;height:150px;"></div>
         <div id="wb_indexText9" style="position:absolute;left:615px;top:367px;width:131px;height:77px;text-align:center;z-index:5;">
            <span style="color:#FFFFFF;font-family:'Proxima Nova Rg';font-size:20px;letter-spacing:0.07px;">Цена<br>под ключ </span><span style="color:#FFFFFF;font-family:FuturaBookC;font-size:20px;letter-spacing:0.07px;"><br></span><span style="color:#FFFFFF;font-family:'Proxima Nova Th';font-size:24px;letter-spacing:0.07px;">18 689 р.</span></div>
         <div id="wb_indexImage2" style="position:absolute;left:12px;top:353px;width:40px;height:40px;z-index:6;">
            <img src="images/img0007.png" id="indexImage2" alt=""></div>
         <div id="wb_indexText14" style="position:absolute;left:69px;top:359px;width:170px;height:26px;z-index:7;">
            <span style="color:#303030;font-family:'Proxima Nova Rg';font-size:21px;letter-spacing:0.07px;">Гарантия 5 лет</span></div>
<!--         <div id="wb_indexText15" style="position:absolute;left:315px;top:359px;width:255px;height:26px;z-index:8;">-->
<!--            <span style="color:#303030;font-family:'Proxima Nova Rg';font-size:21px;letter-spacing:0.07px;">Бесплатная установка</span></div>-->
<!--         <div id="wb_indexImage3" style="position:absolute;left:257px;top:353px;width:40px;height:40px;z-index:9;">-->
<!--            <img src="images/img0008.png" id="indexImage3" alt=""></div> -->
         <div id="wb_indexImage5" style="position:absolute;left:469px;top:590px;width:31px;height:31px;z-index:11;">
            <img src="images/img0001.png" id="indexImage5" alt=""></div>
      </div>
   </div>
   <div id="indexLayer3" style="position:absolute;text-align:center;left:0.1031%;top:0px;width:99.8969%;height:91px;z-index:123;">
      <div id="indexLayer3_Container" style="width:969px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
         <div id="wb_indexImage4" style="position:absolute;left:564px;top:35px;width:24px;height:24px;z-index:12;">
            <img src="images/img0009.png" id="indexImage4" alt=""></div>
         <div id="wb_indexText8" style="position:absolute;left:575px;top:35px;width:201px;height:26px;text-align:right;z-index:13;">
            <span style="color:#404040;font-family:'Proxima Nova Rg';font-size:21px;letter-spacing:0.07px;">+7 (925) 497-05-07</span></div>
         <div id="wb_indexShape8" style="position:absolute;left:788px;top:23px;width:173px;height:44px;z-index:14;">
            <a href="javascript:displaylightbox('./zvonok.php',{scrolling:'no'})" target="_self"><img src="images/img0010.png" id="indexShape8" alt="" style="width:173px;height:44px;"></a></div>
         <div id="wb_indexText44" style="position:absolute;left:271px;top:23px;width:276px;height:38px;z-index:15;">
            <span style="color:#303030;font-family:'Proxima Nova Rg';font-size:16px;letter-spacing:0.07px;">Американские стандарты качества, экологии и безопасности</span></div>
         <div id="wb_indexImage19" style="position:absolute;left:6px;top:18px;width:194px;height:49px;z-index:16;">
            <img src="images/!bone.crusher.logo.jpg" id="indexImage19" alt=""></div>
         <div id="wb_indexImage27" style="position:absolute;left:220px;top:4px;width:38px;height:76px;z-index:17;">
            <img src="images/244.png" id="indexImage27" alt=""></div>
      </div>
   </div>
   <div id="indexLayer4" style="position:absolute;text-align:center;left:0%;top:744px;width:99.7938%;height:504px;z-index:124;">
      <div id="indexLayer4_Container" style="width:968px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
         <div id="wb_indexShape74" style="position:absolute;left:10px;top:90px;width:334px;height:324px;z-index:18;">
            <img src="images/img0002.png" id="indexShape74" alt="" style="width:334px;height:324px;"></div>
         <div id="wb_indexText30" style="position:absolute;left:429px;top:111px;width:523px;height:52px;z-index:19;">
            <span style="color:#05C00F;font-family:'Proxima Nova Th';font-size:43px;letter-spacing:1.07px;">ЧИСТОТА И ЭКОЛОГИЯ</span></div>
         <div id="wb_indexText3" style="position:absolute;left:429px;top:172px;width:535px;height:63px;z-index:20;">
            <span style="color:#303030;font-family:'Proxima Nova Rg';font-size:17px;letter-spacing:0.07px;">Измельчитель пищевых отходов устраняет источники бактерий <br>и насекомых, а также он очень удобен в обращении: просто нажмите кнопку и пищевых отходы исчезнут. </span></div>
         <div id="wb_indexShape1" style="position:absolute;left:429px;top:312px;width:6px;height:70px;z-index:21;">
            <img src="images/img0011.png" id="indexShape1" alt="" style="width:6px;height:70px;"></div>
         <div id="wb_indexText4" style="position:absolute;left:429px;top:272px;width:533px;height:29px;z-index:22;">
            <span style="color:#0080FA;font-family:'Proxima Nova Rg';font-size:24px;letter-spacing:1.07px;">ОХРАНА ОКРУЖАЮЩЕЙ СРЕДЫ:</span></div>
         <div id="wb_indexText5" style="position:absolute;left:455px;top:311px;width:485px;height:72px;z-index:23;">
            <span style="color:#515151;font-family:'Proxima Nova Rg';font-size:20px;letter-spacing:0.07px;">Быстрое решение проблемы пищевых отходов<br>Снижение кол-ва мусора на 50-70%<br>Образование ценных удобрений</span></div>
      </div>
   </div>
   <!--here-->
   <div id="indexLayer1" style="position:absolute;text-align:center;left:0%;top:1860px;width:100%;height:767px;z-index:125;">
      <div id="indexLayer1_Container" style="width:970px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
         <div id="indexSlideShow1" style="position:absolute;left:570px;top:536px;width:101px;height:143px;z-index:24;">
            <a href="images/111.jpg" data-rel=""><img class="image" src="images/111.jpg" alt="" title=""></a>
<!--            <a href="images/222.jpg" data-rel=""><img class="image" src="images/222.jpg" style="display:none;" alt="" title=""></a>-->
         </div>
         <div id="wb_indexShape15" style="position:absolute;left:612px;top:415px;width:333px;height:86px;z-index:25;">
            <img src="images/img0003.png" id="indexShape15" alt="" style="width:333px;height:86px;"></div>
         <div id="wb_indexShape14" style="position:absolute;left:275px;top:317px;width:308px;height:184px;z-index:26;">
            <img src="images/img0018.png" id="indexShape14" alt="" style="width:308px;height:184px;"></div>
         <div id="wb_indexText6" style="position:absolute;left:52px;top:90px;width:867px;height:52px;text-align:center;z-index:27;">
            <span style="color:#303030;font-family:'Proxima Nova Th';font-size:43px;letter-spacing:1.07px;">МОДЕЛЬ ВС 610</span></div>
         <div id="wb_indexShape13" style="position:absolute;left:612px;top:317px;width:333px;height:86px;z-index:28;">
            <img src="images/img0019.png" id="indexShape13" alt="" style="width:333px;height:86px;"></div>
         <div id="wb_indexShape2" style="position:absolute;left:275px;top:615px;width:225px;height:65px;z-index:29;">
            <a href="javascript:displaylightbox('./zakaz.php',{scrolling:'no'})" target="_self"><img src="images/img0020.png" id="indexShape2" alt="" style="width:225px;height:65px;"></a></div>
         <div id="wb_indexText7" style="position:absolute;left:275px;top:552px;width:255px;height:52px;z-index:30;">
            <span style="color:#0080FA;font-family:'Proxima Nova Th';font-size:43px;letter-spacing:0.07px;">18 689 руб</span></div>
         <div id="wb_indexText10" style="position:absolute;left:275px;top:191px;width:693px;height:92px;z-index:31;">
            <span style="color:#303030;font-family:'Proxima Nova Rg';font-size:19px;letter-spacing:0.07px;">Ориентирован на экономию пространства под мойкой, тем не менее, <br>обладает многими опциями старших моделей. Разработан для семьи из двух-трех человек любящих домашний уют и предпочитающих самостоятельно творить на кухне. Идеальный выбор для экономного потребителя.</span></div>
         <div id="wb_indexText11" style="position:absolute;left:697px;top:346px;width:220px;height:35px;z-index:32;">
            <span style="color:#0080FA;font-family:'Proxima Nova Rg';font-size:29px;letter-spacing:0.07px;"><strong>Гарантия 5 лет</strong></span></div>
         <div id="wb_indexText16" style="position:absolute;left:311px;top:336px;width:197px;height:105px;z-index:33;">
            <span style="color:#303030;font-family:'Proxima Nova Rg';font-size:17px;letter-spacing:0.07px;">Цвет <br>Объем камеры		 <br>Диаметр прибора		 <br>Высота прибора		 <br>Производитель	</span></div>
         <div id="wb_indexText17" style="position:absolute;left:485px;top:336px;width:102px;height:105px;z-index:34;">
            <span style="color:#303030;font-family:'Proxima Nova Rg';font-size:17px;letter-spacing:0.07px;"><strong>Черный	 <br>600 мл	 <br>132 мм	 <br>364 мм	&nbsp; <br>США</strong></span></div>
         <div id="wb_indexText13" style="position:absolute;left:637px;top:426px;width:309px;height:58px;z-index:35;">
            <span style="color:#0080FA;font-family:'Proxima Nova Rg';font-size:29px;letter-spacing:0.07px;"><strong>В комплекте:</strong></span><span style="color:#0080FA;font-family:FuturaMediumC;font-size:29px;letter-spacing:0.07px;"> </span><span style="color:#515151;font-family:'Proxima Nova Rg';font-size:19px;letter-spacing:0.07px;">крышка-<br>толкатель, пневмо-выключатель</span></div>
         <div id="wb_indexText19" style="position:absolute;left:277px;top:529px;width:275px;height:21px;z-index:36;">
            <span style="color:#515151;font-family:'Proxima Nova Rg';font-size:17px;letter-spacing:0.07px;">Цена под ключ c установкой</span></div>
         <div id="wb_indexImage28" style="position:absolute;left:633px;top:336px;width:49px;height:49px;z-index:37;">
            <img src="images/badge.png" id="indexImage28" alt=""></div>
         <div id="wb_indexImage24" style="position:absolute;left:643px;top:653px;width:23px;height:23px;z-index:38;">
            <img src="images/magnifier.png" id="indexImage24" alt=""></div>
         <div id="wb_indexShape25" style="position:absolute;left:695px;top:536px;width:247px;height:141px;z-index:39;">
            <img src="images/img0039.png" id="indexShape25" alt="" style="width:247px;height:141px;"></div>
         <div id="wb_indexText12" style="position:absolute;left:694px;top:564px;width:249px;height:33px;text-align:center;z-index:40;">
            <span style="color:#FFFFFF;font-family:'Proxima Nova Rg';font-size:27px;letter-spacing:0.07px;">Домашний тест</span></div>
         <div id="wb_indexShape28" style="position:absolute;left:807px;top:610px;width:27px;height:32px;z-index:41;">
            <img src="images/img0041.png" id="indexShape28" alt="" style="width:27px;height:32px;"></div>
         <div id="wb_indexShape26" style="position:absolute;left:694px;top:536px;width:247px;height:141px;z-index:42;">
            <a href="javascript:displaylightbox('./video.php',{scrolling:'no'})" target="_self"><img src="images/img0042.png" id="indexShape26" alt="" style="width:247px;height:141px;"></a></div>
         <div id="wb_indexText34" style="position:absolute;left:311px;top:451px;width:251px;height:26px;z-index:43;">
            <span style="color:#0080FA;font-family:'Proxima Nova Rg';font-size:21px;letter-spacing:0.07px;"><u><a href="javascript:displaylightbox('./1.html',{width:820,height:660})" target="_self" class="style1">Все характеристики</a></u></span></div>
         <div id="wb_indexImage29" style="position:absolute;left:6px;top:179px;width:289px;height:500px;z-index:44;">
            <img src="images/242525.png" id="indexImage29" alt=""></div>
      </div>
   </div>
   <section class="newBanner" style="position:absolute;text-align:center;left:0%;top:2627px;width:100%;height:600px;z-index:130; background-color: white;">
     <div class="newBanner__container">
       <h2 class="newBanner__title">
         Дополнительные аксессуары
         <br>
         для удобного использования!
       </h2>

       <div class="newBanner__row">
         <div class="newBanner__col-4">
           <div class="newBanner__img-box">
             <img src="images/new-img-1.png" alt="">
           </div>
         </div>
         <div class="newBanner__col-4">
           <div class="newBanner__img-box">
             <img src="images/new-img-2.png" alt="">
           </div>
         </div>
          <!-- txt-col -->
         <div class="newBanner__col-4 txt-col">
           <div class="newBanner__price-item">
             <div class="newBanner__price-descr">
               Цена пульта
             </div>
             <div class="newBanner__price-val">
               3 600 руб
             </div>
           </div>
           <div class="newBanner__price-item">
             <div class="newBanner__price-descr">
               Цена клавиши
             </div>
             <div class="newBanner__price-val">
               3 900 руб
             </div>
           </div>
         </div>
       </div>
     </div>

   </section>
    <!--here-->
   <div id="indexLayer5" style="position:absolute;text-align:center;left:0%;top:1248px;width:100%;height:612px;z-index:126;">
      <div id="indexLayer5_Container" style="width:970px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
         <div id="wb_indexShape4" style="position:absolute;left:11px;top:195px;width:87px;height:87px;z-index:45;">
            <img src="images/img0012.png" id="indexShape4" alt="" style="width:87px;height:87px;"></div>
         <div id="wb_indexText22" style="position:absolute;left:113px;top:214px;width:368px;height:46px;z-index:46;">
            <span style="color:#303030;font-family:'Proxima Nova Rg';font-size:19px;letter-spacing:0.07px;">Автоматическая защита <br>от перегрузок</span></div>
         <div id="wb_indexShape7" style="position:absolute;left:518px;top:195px;width:87px;height:87px;z-index:47;">
            <img src="images/img0013.png" id="indexShape7" alt="" style="width:87px;height:87px;"></div>
         <div id="wb_indexText23" style="position:absolute;left:625px;top:214px;width:289px;height:46px;z-index:48;">
            <span style="color:#303030;font-family:'Proxima Nova Rg';font-size:19px;letter-spacing:0.07px;">Подходит для любых <br>пищевых отходов</span></div>
         <div id="wb_indexShape9" style="position:absolute;left:518px;top:313px;width:87px;height:87px;z-index:49;">
            <img src="images/img0014.png" id="indexShape9" alt="" style="width:87px;height:87px;"></div>
         <div id="wb_indexText25" style="position:absolute;left:113px;top:322px;width:370px;height:69px;z-index:50;">
            <span style="color:#303030;font-family:'Proxima Nova Rg';font-size:19px;letter-spacing:0.07px;">Экономное потребление электроэнергии<br>от 475 до 520 Вт (в 3 раза меньше <br>электрочайника)</span></div>
         <div id="wb_indexShape10" style="position:absolute;left:10px;top:313px;width:87px;height:87px;z-index:51;">
            <img src="images/img0015.png" id="indexShape10" alt="" style="width:87px;height:87px;"></div>
         <div id="wb_indexShape11" style="position:absolute;left:518px;top:430px;width:87px;height:87px;z-index:52;">
            <img src="images/img0016.png" id="indexShape11" alt="" style="width:87px;height:87px;"></div>
         <div id="wb_indexText27" style="position:absolute;left:112px;top:430px;width:383px;height:92px;z-index:53;">
            <span style="color:#303030;font-family:'Proxima Nova Rg';font-size:19px;letter-spacing:0.07px;">Чистота и гигиена. Диспоузер полностью <br>удаляет пищевые отходы из сливной камеры.Не требует использования чистящих средств для промывки камеры</span></div>
         <div id="wb_indexShape12" style="position:absolute;left:10px;top:432px;width:87px;height:87px;z-index:54;">
            <img src="images/img0017.png" id="indexShape12" alt="" style="width:87px;height:87px;"></div>
         <div id="wb_indexText24" style="position:absolute;left:625px;top:322px;width:321px;height:69px;z-index:55;">
            <span style="color:#303030;font-family:'Proxima Nova Rg';font-size:19px;letter-spacing:0.07px;">Легкий вес (4-6 кг) и отсутствие вибрации позволяет установить <br>прибор на любой тип моек</span></div>
         <div id="wb_indexText26" style="position:absolute;left:625px;top:431px;width:343px;height:92px;z-index:56;">
            <span style="color:#303030;font-family:'Proxima Nova Rg';font-size:19px;letter-spacing:0.07px;">Использование - безопасно, т.к. <br>отсутствуют ножи, а измельчающие<br>кулачки и дробильный диск <br>находятся глубоко в приборе</span></div>
         <div id="wb_indexText21" style="position:absolute;left:51px;top:89px;width:867px;height:52px;text-align:center;z-index:57;">
            <span style="color:#0080FA;font-family:'Proxima Nova Th';font-size:43px;letter-spacing:1.07px;">6 ПРИЧИН ВЫБРАТЬ BONECRUSHER</span></div>
         <div id="wb_indexImage1" style="position:absolute;left:30px;top:215px;width:48px;height:48px;z-index:58;">
            <img src="images/flash.png" id="indexImage1" alt=""></div>
         <div id="wb_indexImage10" style="position:absolute;left:538px;top:448px;width:48px;height:48px;z-index:59;">
            <img src="images/like.png" id="indexImage10" alt=""></div>
         <div id="wb_indexImage6" style="position:absolute;left:537px;top:213px;width:52px;height:52px;z-index:60;">
            <img src="images/carrot.png" id="indexImage6" alt=""></div>
         <div id="wb_indexImage9" style="position:absolute;left:30px;top:451px;width:49px;height:49px;z-index:61;">
            <img src="images/recycling.png" id="indexImage9" alt=""></div>
         <div id="wb_indexImage8" style="position:absolute;left:535px;top:330px;width:53px;height:53px;z-index:62;">
            <img src="images/sink.png" id="indexImage8" alt=""></div>
         <div id="wb_indexImage7" style="position:absolute;left:29px;top:330px;width:50px;height:50px;z-index:63;">
            <img src="images/pig-money-safe.png" id="indexImage7" alt=""></div>
      </div>
   </div>
   <div id="indexLayer12" style="position:absolute;text-align:center;left:0%;top:5672px;width:100%;height:511px;z-index:127;">
      <div id="indexLayer12_Container" style="width:970px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
         <div id="wb_indexImage35" style="position:absolute;left:299px;top:90px;width:373px;height:330px;z-index:67;">
            <img src="images/forma!.png" id="indexImage35" alt=""></div>
         <div id="wb_Text13" style="position:absolute;left:307px;top:122px;width:354px;height:45px;text-align:center;z-index:68;" class="wow fadeIn" data-wow-offset="30" data-wow-iteration="1">
            <span style="color:#404040;font-family:'Proxima Nova Th';font-size:37px;letter-spacing:0.07px;">Оставьте заявку</span></div>
         <div id="wb_indexText73" style="position:absolute;left:298px;top:173px;width:372px;height:52px;text-align:center;z-index:69;">
            <span style="color:#303030;font-family:'Proxima Nova Rg';font-size:21px;letter-spacing:0.07px;">на бесплатную консультацию<br>специалиста по телефону</span></div>
         <div id="wb_indexForm3" style="position:absolute;left:328px;top:209px;width:307px;height:147px;z-index:70;">
            <form name="contact2" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="indexForm3">
               <input type="hidden" name="formid" value="indexform3">
               <input type="text" id="indexEditbox2" style="position:absolute;left:29px;top:26px;width:216px;height:50px;line-height:50px;z-index:64;" name="Телефон" value="" spellcheck="false" required="" placeholder="&#1042;&#1072;&#1096; &#1090;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;" class="phone">
               <div id="wb_indexImage20" style="position:absolute;left:231px;top:44px;width:16px;height:14px;z-index:65;">
                  <img src="images/img0024.png" id="indexImage20" alt=""></div>
               <input type="submit" id="zvonokButton1" name="" value="Отправить" style="position:absolute;left:29px;top:84px;width:236px;height:53px;z-index:66;">
            </form>
         </div>
         <div id="wb_indexText36" style="position:absolute;left:297px;top:371px;width:372px;height:32px;text-align:center;z-index:71;">
            <span style="color:#303030;font-family:'Proxima Nova Rg';font-size:13px;letter-spacing:0.07px;"><a href="personaldata.pdf" target="_blank" class="style1">Отправляя заявку, Вы даете Согласие<br>на обработку персональных данных</a></span></div>
      </div>
   </div>
   <div id="indexLayer9" style="position:absolute;text-align:center;left:0%;top:3227px;width:100%;height:618px;z-index:1000;">
      <div id="indexLayer9_Container" style="width:970px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
         <div id="wb_indexShape18" style="position:absolute;left:749px;top:188px;width:138px;height:138px;z-index:75;">
            <img src="images/img0021.png" id="indexShape18" alt="" style="width:138px;height:138px;"></div>
         <div id="wb_indexShape17" style="position:absolute;left:416px;top:188px;width:138px;height:138px;z-index:76;">
            <img src="images/img0022.png" id="indexShape17" alt="" style="width:138px;height:138px;"></div>
         <div id="wb_indexShape16" style="position:absolute;left:86px;top:188px;width:138px;height:138px;z-index:77;">
            <img src="images/img0023.png" id="indexShape16" alt="" style="width:138px;height:138px;"></div>
         <div id="wb_indexImage12" style="position:absolute;left:110px;top:215px;width:91px;height:97px;z-index:78;">
            <img src="images/fkrwinwm30-2.png" id="indexImage12" alt=""></div>
         <div id="wb_indexText63" style="position:absolute;left:6px;top:343px;width:298px;height:138px;text-align:center;z-index:79;">
            <span style="color:#FFFFFF;font-family:'Proxima Nova Rg';font-size:19px;letter-spacing:0.07px;">Использование запатентованных антибактериальных добавок <br>BIO SHIELD в корпус прибора&nbsp; препятствует распространению болезнетворных бактерий <br>в камере измельчителя</span></div>
         <div id="wb_indexText64" style="position:absolute;left:336px;top:343px;width:298px;height:207px;text-align:center;z-index:80;">
            <span style="color:#FFFFFF;font-family:'Proxima Nova Rg';font-size:19px;letter-spacing:0.07px;">Высокие обороты и плавность хода дополнительно отбалансированного двигателя Anaheim Bone Crusher снижает вибрацию и шум при работе прибора, а в купе с полной шумоизоляцией делает использование прибора <br>более комфортным</span></div>
         <div id="wb_indexText65" style="position:absolute;left:671px;top:343px;width:293px;height:207px;text-align:center;z-index:81;">
            <span style="color:#FFFFFF;font-family:'Proxima Nova Rg';font-size:19px;letter-spacing:0.07px;">Только в измельчителях пищевых отходов Anaheim <br>Bone Crusher есть магнитный уловитель на горловину измельчителя, препятствующий попаданию столовых приборов <br>и других металлических предметов уже <br>в комплекте</span></div>
         <div id="wb_indexImage17" style="position:absolute;left:424px;top:198px;width:126px;height:119px;z-index:82;">
            <img src="images/8m8ritkkso-2.png" id="indexImage17" alt=""></div>
         <div id="wb_indexImage21" style="position:absolute;left:744px;top:206px;width:143px;height:94px;z-index:83;">
            <img src="images/4b37xnb2pq-2.jpg" id="indexImage21" alt=""></div>
         <div id="wb_indexText18" style="position:absolute;left:28px;top:90px;width:915px;height:52px;text-align:center;z-index:84;">
            <span style="color:#FFFFFF;font-family:'Proxima Nova Th';font-size:43px;letter-spacing:1.07px;">ЗАПАТЕНТОВАННЫЕ ТЕХНОЛОГИИ</span></div>
      </div>
   </div>
   <div id="indexLayer6" style="position:absolute;text-align:center;left:0%;top:3845px;width:100%;height:710px;z-index:129;">
      <div id="indexLayer6_Container" style="width:970px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
         <div id="wb_indexText20" style="position:absolute;left:53px;top:80px;width:867px;height:52px;text-align:center;z-index:85;">
            <span style="color:#0080FA;font-family:'Proxima Nova Th';font-size:43px;letter-spacing:1.07px;">ОТВЕТЫ НА ВОПРОСЫ</span></div>
         <div id="wb_indexText57" style="position:absolute;left:23px;top:214px;width:941px;height:115px;z-index:86;">
            <span style="color:#303030;font-family:'Proxima Nova Rg';font-size:19px;letter-spacing:0.07px;">Диспоузер может быть установлен в любую мойку, в том числе и из нержавеющей стали, а так же <br>в мойки предыдущего поколения, размер слива которых составляет&nbsp; менее 90 мм. Используя&nbsp; специальный прибор,&nbsp; отверстие&nbsp; будет увеличено, в результате чего работа диспоузера будет выполняться правильно. Установка измельчителя пищевых отходов может&nbsp; производиться не только квалифицированным специалистом, но и собственными силами. Гарантия в обоих случаях сохраняется.</span></div>
         <div id="wb_indexText58" style="position:absolute;left:23px;top:165px;width:881px;height:43px;z-index:87;">
            <span style="color:#05C00F;font-family:'Proxima Nova Rg';font-size:35px;letter-spacing:0.07px;"><strong>Нужна ли специальная мойка для диспоузер?</strong></span></div>
         <div id="wb_indexText28" style="position:absolute;left:23px;top:400px;width:941px;height:92px;z-index:88;">
            <span style="color:#303030;font-family:'Proxima Nova Rg';font-size:19px;letter-spacing:0.07px;">Запуск диспоузера займет у вас лишь несколько секунд. Для начала работы вам потребуется включить<br> воду в кране, нажать на кнопку запуска, загрузить пищевые отходы в измельчитель при помощи специальной лопатки или другого подручного средства. После окончания работы, выключите прибор <br>и воду.</span></div>
         <div id="wb_indexText29" style="position:absolute;left:23px;top:351px;width:881px;height:43px;z-index:89;">
            <span style="color:#05C00F;font-family:'Proxima Nova Rg';font-size:35px;letter-spacing:0.07px;"><strong>Как пользоваться диспоузером?</strong></span></div>
         <div id="wb_indexText31" style="position:absolute;left:23px;top:518px;width:881px;height:43px;z-index:90;">
            <span style="color:#05C00F;font-family:'Proxima Nova Rg';font-size:35px;letter-spacing:0.07px;"><strong>Насколько он безопасен?</strong></span></div>
         <div id="wb_indexText32" style="position:absolute;left:22px;top:561px;width:930px;height:69px;z-index:91;">
            <span style="color:#303030;font-family:'Proxima Nova Rg';font-size:19px;letter-spacing:0.07px;">Измельчители разработаны согласно европейским и американским стандартам, благодаря чему их правильное использование является безопасным. Дробильная система диспоузера расположена глубоко внутри прибора, что обеспечивает максимальную безопасность.</span></div>
      </div>
   </div>
   <div id="indexLayer8" style="position:absolute;text-align:center;left:0%;top:4555px;width:99.7938%;height:1117px;z-index:130;">
      <div id="indexLayer8_Container" style="width:968px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
         <div id="wb_indexShape24" style="position:absolute;left:13px;top:772px;width:459px;height:255px;z-index:92;">
            <img src="images/img0030.png" id="indexShape24" alt="" style="width:459px;height:255px;"></div>
         <div id="wb_indexShape23" style="position:absolute;left:494px;top:551px;width:459px;height:324px;z-index:93;">
            <img src="images/img0031.png" id="indexShape23" alt="" style="width:459px;height:324px;"></div>
         <div id="wb_indexShape22" style="position:absolute;left:13px;top:454px;width:459px;height:293px;z-index:94;">
            <img src="images/img0029.png" id="indexShape22" alt="" style="width:459px;height:293px;"></div>
         <div id="wb_indexShape21" style="position:absolute;left:494px;top:188px;width:459px;height:338px;z-index:95;">
            <img src="images/img0028.png" id="indexShape21" alt="" style="width:459px;height:338px;"></div>
         <div id="wb_indexText40" style="position:absolute;left:529px;top:223px;width:411px;height:210px;z-index:96;">
            <span style="color:#303030;font-family:'Proxima Nova Rg';font-size:17px;letter-spacing:0.07px;">&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; Увидев впервые&nbsp; измельчитель у друзей, жена загорелась желанием установить на нашей кухне такой же. Очень долго искал что-то, что будет соответствовать нашему бюджету и в то же время быть качественным. Знакомые уже имели горький опыт покупки подделки. Я все же нашел и приобрел американский прибор, который на 100% соответствует своим гарантиям. Это идеальная модель, в которой сочетаются как качество, так и цена. </span></div>
         <div id="wb_indexShape20" style="position:absolute;left:13px;top:188px;width:459px;height:241px;z-index:97;">
            <img src="images/img0027.png" id="indexShape20" alt="" style="width:459px;height:241px;"></div>
         <div id="wb_indexText35" style="position:absolute;left:52px;top:90px;width:867px;height:52px;text-align:center;z-index:98;">
            <span style="color:#303030;font-family:'Proxima Nova Th';font-size:43px;letter-spacing:1.07px;">ОТЗЫВЫ</span></div>
         <div id="wb_indexText37" style="position:absolute;left:48px;top:223px;width:423px;height:126px;z-index:99;">
            <span style="color:#303030;font-family:'Proxima Nova Rg';font-size:17px;letter-spacing:0.07px;">&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; Давно хотела приобрести измельчитель. Увы, <br>при изучении ценового рынка, заметно испугалась: <br>не хочется отдавать кучу денег за малоизвестный прибор. Но в итоге нашла отличную модель Bone Crusher, которая сочетает в себе все то, что мне <br>было нужно - цену и качество.</span></div>
         <div id="wb_indexText38" style="position:absolute;left:98px;top:373px;width:217px;height:29px;z-index:100;">
            <span style="color:#0080FA;font-family:'Proxima Nova Rg';font-size:24px;letter-spacing:0.07px;">Ксения Алехина</span></div>
         <div id="wb_indexImage18" style="position:absolute;left:47px;top:370px;width:34px;height:34px;z-index:101;">
            <img src="images/mother.png" id="indexImage18" alt=""></div>
         <div id="wb_indexText39" style="position:absolute;left:579px;top:470px;width:299px;height:29px;z-index:102;">
            <span style="color:#0080FA;font-family:'Proxima Nova Rg';font-size:24px;letter-spacing:0.07px;"> Алексей Тренькович</span></div>
         <div id="wb_indexImage22" style="position:absolute;left:531px;top:467px;width:34px;height:34px;z-index:103;">
            <img src="images/grandfather.png" id="indexImage22" alt=""></div>
         <div id="wb_indexText41" style="position:absolute;left:145px;top:685px;width:240px;height:29px;z-index:104;">
            <span style="color:#0080FA;font-family:'Proxima Nova Rg';font-size:24px;letter-spacing:0.07px;">Валентина и Денис</span></div>
         <div id="wb_indexText42" style="position:absolute;left:48px;top:489px;width:411px;height:168px;z-index:105;">
            <span style="color:#303030;font-family:'Proxima Nova Rg';font-size:17px;letter-spacing:0.07px;">&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; У нас очень большая семья, и проблема <br>запахов на кухне долгое время была проблемой. Боролись, как могли, но в итоге спасение нашли только в приобретении измельчителя пищевых отходов. Особенно радует тот факт, что он работает достаточно тихо, прост в эксплуатации <br>и безопасен. Опять же, весьма порадовала цена, которая не уменьшает качество прибора. </span></div>
         <div id="wb_indexImage25" style="position:absolute;left:50px;top:682px;width:34px;height:34px;z-index:106;">
            <img src="images/hipster.png" id="indexImage25" alt=""></div>
         <div id="wb_indexImage23" style="position:absolute;left:84px;top:682px;width:34px;height:34px;z-index:107;">
            <img src="images/scientist-woman.png" id="indexImage23" alt=""></div>
         <div id="wb_indexText45" style="position:absolute;left:530px;top:589px;width:411px;height:189px;z-index:108;">
            <span style="color:#303030;font-family:'Proxima Nova Rg';font-size:17px;letter-spacing:0.07px;">&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; Муж обожает рыбалку, откуда часто <br>привозит по несколько килограммов рыбы. Естественно чистка занимает много времени, <br>а запахи от отходов держатся по несколько часов. Нашли хорошее решение в приобретении качественного, но при этом весьма бюджетного, измельчителя пищевых отходов. Больше не приходится вычищать мойку от рыбной чешуи, <br>а неприятный запах давно покинул нашу кухню. </span></div>
         <div id="wb_indexText46" style="position:absolute;left:98px;top:961px;width:240px;height:29px;z-index:109;">
            <span style="color:#0080FA;font-family:'Proxima Nova Rg';font-size:24px;letter-spacing:0.07px;">Александр Визер</span></div>
         <div id="wb_indexText47" style="position:absolute;left:48px;top:807px;width:411px;height:168px;z-index:110;">
            <span style="color:#303030;font-family:'Proxima Nova Rg';font-size:17px;letter-spacing:0.07px;">&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; После капитального ремонта на кухне, <br>решили с женой поменять всю технику. Случайно наткнулись на такую вещь, как диспоузер, который был нам знаком лишь по американским фильмам. Ради интереса решили приобрести, о чем не жалеем по сей день. <br><br></span></div>
         <div id="wb_indexImage16" style="position:absolute;left:50px;top:958px;width:34px;height:34px;z-index:111;">
            <img src="images/professor.png" id="indexImage16" alt=""></div>
         <div id="wb_indexText43" style="position:absolute;left:630px;top:814px;width:236px;height:29px;z-index:112;">
            <span style="color:#0080FA;font-family:'Proxima Nova Rg';font-size:24px;letter-spacing:0.07px;">Кристина и Максим </span></div>
         <div id="wb_indexImage26" style="position:absolute;left:566px;top:811px;width:34px;height:34px;z-index:113;">
            <img src="images/lawyer.png" id="indexImage26" alt=""></div>
         <div id="wb_indexImage13" style="position:absolute;left:531px;top:811px;width:34px;height:34px;z-index:114;">
            <img src="images/professor.png" id="indexImage13" alt=""></div>
      </div>
   </div>
   <div id="indexLayer7" style="position:absolute;text-align:center;left:0%;top:6183px;width:100%;height:160px;z-index:131;">
      <div id="indexLayer7_Container" style="width:970px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
         <div id="wb_indexImage14" style="position:absolute;left:552px;top:52px;width:24px;height:24px;z-index:115;">
            <img src="images/img0025.png" id="indexImage14" alt=""></div>
         <div id="wb_indexText33" style="position:absolute;left:568px;top:50px;width:210px;height:26px;text-align:right;z-index:116;">
            <span style="color:#FFFFFF;font-family:'Proxima Nova Rg';font-size:21px;letter-spacing:1.07px;">+7 (925) 497-05-07</span></div>
         <div id="wb_indexShape19" style="position:absolute;left:788px;top:40px;width:173px;height:44px;z-index:117;">
            <a href="javascript:displaylightbox('./zvonok.php',{scrolling:'no'})" target="_self"><img src="images/img0026.png" id="indexShape19" alt="" style="width:173px;height:44px;"></a></div>
         <div id="wb_indexText49" style="position:absolute;left:271px;top:40px;width:276px;height:38px;z-index:118;">
            <span style="color:#FFFFFF;font-family:'Proxima Nova Rg';font-size:16px;letter-spacing:0.07px;">Американские стандарты качества, экологии и безопасности</span></div>
         <div id="wb_indexImage15" style="position:absolute;left:6px;top:35px;width:194px;height:49px;z-index:119;">
            <img src="images/!bone.crusher.logo.jpg" id="indexImage15" alt=""></div>
         <div id="wb_indexImage32" style="position:absolute;left:220px;top:21px;width:38px;height:76px;z-index:120;">
            <img src="images/244.png" id="indexImage32" alt=""></div>
         <div id="wb_indexText68" style="position:absolute;left:313px;top:115px;width:349px;height:18px;text-align:center;z-index:121;">
            <span style="color:#FFFFFF;font-family:'Proxima Nova Rg';font-size:15px;letter-spacing:0.07px;"><a href="personaldata.pdf" target="_blank" class="style2">Политика конфиденциальности</a></span></div>
      </div>
   </div>
<!-- Yandex.Metrika counter -->
   <script>
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter47064684 = new Ya.Metrika({
                        id:47064684,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true,
                        webvisor:true
                    });
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
   </script>
   <noscript><div><img src="https://mc.yandex.ru/watch/47064684"
style="position:absolute; left:-9999px;" alt=""/></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>