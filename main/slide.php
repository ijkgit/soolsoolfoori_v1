<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSS 슬라이더</title>
    <link rel="stylesheet" href="./css/slide.css">
    <link rel="stylesheet" href="./css/common.css">
</head>

<script>

// showSlides();

// /*window.onload = */function showSlides(){
    
//     var s1 = document.getElementById('slide1').checked;
//     var s2 = document.getElementById('slide2').checked;
//     var s3 = document.getElementById('slide3').checked;

//     if(s1 == true) {
//         s1 = false;
//         s2 = true;
//     }
//     else if(s2 == true) {
//         s2 = false;
//         s3 = true;
//     }
//     else if(s3 == true) {
//         s3 = false;
//         s1 = true;
//     }
//     setTimeout(showSlides, 1000);
// };

window.onload = function showSlides(){
    
    if(document.getElementById('slide1').checked == true) {
        document.getElementById('slide1').checked == false;
        document.getElementById('slide2').checked = true;
    }
    else if(document.getElementById('slide2').checked == true) {
        document.getElementById('slide2').checked == false;
        document.getElementById('slide3').checked = true;
    }
    else if(document.getElementById('slide3').checked == true) {
        document.getElementById('slide3').checked == false;
        document.getElementById('slide1').checked = true;
    }
    else {
        document.getElementById('slide1').checked = true;
    }

    setTimeout(showSlides, 3000);
};

</script>

<body>
<div class="slider" val="1" max="3">
    <input type="radio" name="slide" id="slide1">
    <input type="radio" name="slide" id="slide2">
    <input type="radio" name="slide" id="slide3">
    <ul id="imgholder" class="imgs">
        <li><a href="https://www.youtube.com/watch?v=c4Qlzkyzaio" target="blank"><img class="a" src="./img/main/1.jpg"></a></li>
        <li><a href="https://www.mk.co.kr/news/business/view/2022/04/348784/" target="blank"><img class="a" src="./img/main/2.jpg"></a></li>
        <li><a href="https://www.yna.co.kr/view/AKR20210409090000797" target="blank"><img class="a" src="./img/main/3.jpg"></a></li>
    </ul>
    <div class="bullets">
        <label for="slide1">&nbsp;</label>
        <label for="slide2">&nbsp;</label>
        <label for="slide3">&nbsp;</label>
    </div>
</div>
<!-- <script src="./js/slide.js"></script> -->
</body>
</html>