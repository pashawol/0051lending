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
   $success_url = './ok.php';
   $error_url = '';
   $error = '';
   $eol = "\n";
   $boundary = md5(uniqid(time()));
   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'Cc: '.$mailcc.$eol;
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
<meta name="generator" content="WYSIWYG Web Builder 12 - http://www.wysiwygwebbuilder.com">
<link href="favicon!.ico" rel="shortcut icon" type="image/x-icon">
<link href="zvonok.css" rel="stylesheet">
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async="" 
src="https://www.googletagmanager.com/gtag/js?id=UA-111361183-1"></script>
<script>   
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
   
      gtag('config', 'UA-111361183-1');
</script>
</head>
<body>
   <div id="container">
      <div id="wb_indexShape1" style="position:absolute;left:0px;top:0px;width:560px;height:340px;z-index:5;">
         <img src="images/img0033.png" id="indexShape1" alt="" style="width:560px;height:340px;">
      </div>
      <div id="wb_indexForm3" style="position:absolute;left:123px;top:95px;width:307px;height:183px;z-index:6;">
         <form name="contact2" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="indexForm3">
            <input type="hidden" name="formid" value="indexform3">
            <input type="text" id="indexEditbox1" style="position:absolute;left:39px;top:67px;width:200px;height:45px;line-height:45px;z-index:0;" name="Телефон" value="" spellcheck="false" required="" placeholder="&#1042;&#1072;&#1096; &#1090;&#1077;&#1083;&#1077;&#1092;&#1086;&#1085;" class="phone">
            <div id="wb_indexImage8" style="position:absolute;left:227px;top:84px;width:16px;height:14px;z-index:1;">
               <img src="images/img0034.png" id="indexImage8" alt=""></div>
            <input type="text" id="zvonokEditbox1" style="position:absolute;left:39px;top:15px;width:200px;height:45px;line-height:45px;z-index:2;" name="Имя" value="" spellcheck="false" placeholder="&#1042;&#1072;&#1096;&#1077; &#1080;&#1084;&#1103;">
            <div id="wb_indexImage2" style="position:absolute;left:226px;top:29px;width:18px;height:18px;z-index:3;">
               <img src="images/img0035.png" id="indexImage2" alt=""></div>
            <input type="submit" id="zvonokButton1" name="" value="Отправить" style="position:absolute;left:37px;top:120px;width:220px;height:53px;z-index:4;">
         </form>
      </div>
      <div id="wb_indexText32" style="position:absolute;left:55px;top:76px;width:454px;height:26px;text-align:center;z-index:7;">
         <span style="color:#000000;font-family:'Proxima Nova Rg';font-size:21px;letter-spacing:0.07px;">на бесплатную консультацию</span>
      </div>
      <div id="wb_indexText120" style="position:absolute;left:17px;top:33px;width:530px;height:45px;text-align:center;z-index:8;">
         <span style="color:#303030;font-family:'Proxima Nova Th';font-size:37px;letter-spacing:1.07px;">Оставьте заявку</span>
      </div>
      <div id="wb_indexText36" style="position:absolute;left:94px;top:292px;width:372px;height:32px;text-align:center;z-index:9;">
         <span style="color:#303030;font-family:'Proxima Nova Rg';font-size:13px;letter-spacing:0.07px;"><a href="personaldata.pdf" target="_blank" class="style1">Отправляя заявку, Вы даете Согласие<br>на обработку персональных данных</a></span>
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