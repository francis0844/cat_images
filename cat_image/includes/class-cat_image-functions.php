<?php

add_shortcode( 'cat_image_list', 'cat_image_list' );

function cat_image_list( $attr ){
    ob_start();

    //arguments
    $args = shortcode_atts( array(
     
        'limit' => '10',

    ), $attr );

    //CURL ARGS
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.thecatapi.com/v1/images/search?limit='.$args['limit'].'',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "x-api-key: live_6d0vm2NJPLYEeFbrkRTFaSYfYq5j0LbXROPUkcqXdldUSew7ONj2RN05qKzsLYjj"
    ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
    echo "cURL Error #:" . $err;
    } else {
        //DECODE JSON
        $decoded = json_decode($response);
        $i = 1;
        echo '<div class="cat-image-container grid grid-col-4">';

        //LOOP
        foreach ($decoded as $decode){
            ?>
                <img class="image-<?php echo $i; ?>" src="<?php echo $decode->url; ?>" alt="">
            <?php
        }
        echo '</div>';
    }
    return ob_get_clean();
}