<?php

use App\Verified;
use Illuminate\Database\Seeder;

class VerifiedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Verified::truncate();

        Verified::create([
            'user_id' => 1,
            'title' => 'Destroy All Humans',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim urna mauris, nec tristique lacus euismod sit amet. Pellentesque vulputate neque non ex dapibus suscipit. In sit amet est a erat feugiat mattis. Sed tincidunt mauris sed risus sodales pulvinar ac id nibh. Fusce pulvinar urna libero, vitae pretium nunc tincidunt ac. Integer volutpat ultricies ornare. Fusce bibendum orci convallis cursus fringilla. Nulla facilisi. Quisque eu ullamcorper ex. Duis sit amet turpis massa. Nam feugiat metus sodales, ullamcorper tortor non, tristique neque. Ut imperdiet, ante non aliquam varius, quam dui eleifend justo, sit amet aliquet sapien lectus eget velit. Sed vestibulum magna at urna elementum tincidunt. Praesent risus purus, mollis at diam vel, sollicitudin semper felis. Cras tellus leo, sagittis vitae arcu id, fermentum venenatis risus. Donec in risus quis mauris semper lobortis at in lectus.',
            'image' => 'fjy87cVw0TWoj1wUs3igmwiOS.jpg'
        ]);
    }
}
