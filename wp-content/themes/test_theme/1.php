<?php
global $post;

get_header();


$immovableData = get_fields( get_the_ID());

if ($immovableData){

?><h1><?php the_title()?></h1>



<div class="flex-row left">
    <section>
        <h2>Данны нерухомості</h2>
        <div><strong>Координати:</strong> <?php echo $immovableData['coordinates']?></div>
        <div><strong>Кількість поверхів:</strong> <?php echo $immovableData['floors_number']?></div>
        <div><strong>Тип будівлі:</strong> <?php echo $immovableData['build_type']?></div>
        <div><strong>Екологічність:</strong> <?php echo $immovableData['ecology']?></div>
        <img src="<?php echo $immovableData['image']?>">
    </section>
    <section><h2>Аппартаменти</h2>
        <div><strong>Площа:</strong> <?php echo $immovableData["apartment"]['square']?></div>
        <div><strong>Кількість кімнат:</strong> <?php echo $immovableData["apartment"]['rooms_number']?></div>
        <div><strong>Санвузол:</strong> <?php echo $immovableData["apartment"]['bathroom']?></div>
        <div><strong>Балкон:</strong> <?php echo $immovableData["apartment"]['porch']?></div>
        <img src="<?php echo $immovableData["apartment"]['room_image']?>"></section>
</div><?php

}

get_footer();