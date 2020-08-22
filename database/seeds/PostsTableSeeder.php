<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Post::truncate();

        Post::create([
            'user_id' => 1,
            'title' => 'Just Cause 3',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim urna mauris, nec tristique lacus euismod sit amet. Pellentesque vulputate neque non ex dapibus suscipit. In sit amet est a erat feugiat mattis. Sed tincidunt mauris sed risus sodales pulvinar ac id nibh. Fusce pulvinar urna libero, vitae pretium nunc tincidunt ac. Integer volutpat ultricies ornare. Fusce bibendum orci convallis cursus fringilla. Nulla facilisi. Quisque eu ullamcorper ex. Duis sit amet turpis massa. Nam feugiat metus sodales, ullamcorper tortor non, tristique neque. Ut imperdiet, ante non aliquam varius, quam dui eleifend justo, sit amet aliquet sapien lectus eget velit. Sed vestibulum magna at urna elementum tincidunt. Praesent risus purus, mollis at diam vel, sollicitudin semper felis. Cras tellus leo, sagittis vitae arcu id, fermentum venenatis risus. Donec in risus quis mauris semper lobortis at in lectus.',
            'image' => 'Just-Cause-3-In-Game-Screenshots-20.jpg'
        ]);
        Post::create([
            'user_id' => 2,
            'title' => 'Skate 3 is back',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim urna mauris, nec tristique lacus euismod sit amet. Pellentesque vulputate neque non ex dapibus suscipit. In sit amet est a erat feugiat mattis. Sed tincidunt mauris sed risus sodales pulvinar ac id nibh. Fusce pulvinar urna libero, vitae pretium nunc tincidunt ac. Integer volutpat ultricies ornare. Fusce bibendum orci convallis cursus fringilla. Nulla facilisi. Quisque eu ullamcorper ex. Duis sit amet turpis massa. Nam feugiat metus sodales, ullamcorper tortor non, tristique neque. Ut imperdiet, ante non aliquam varius, quam dui eleifend justo, sit amet aliquet sapien lectus eget velit. Sed vestibulum magna at urna elementum tincidunt. Praesent risus purus, mollis at diam vel, sollicitudin semper felis. Cras tellus leo, sagittis vitae arcu id, fermentum venenatis risus. Donec in risus quis mauris semper lobortis at in lectus.',
            'image' => 'skate.0.jpeg'
        ]);
        Post::create([
            'user_id' => 3,
            'title' => 'Walking Dead TellTale Series',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim urna mauris, nec tristique lacus euismod sit amet. Pellentesque vulputate neque non ex dapibus suscipit. In sit amet est a erat feugiat mattis. Sed tincidunt mauris sed risus sodales pulvinar ac id nibh. Fusce pulvinar urna libero, vitae pretium nunc tincidunt ac. Integer volutpat ultricies ornare. Fusce bibendum orci convallis cursus fringilla. Nulla facilisi. Quisque eu ullamcorper ex. Duis sit amet turpis massa. Nam feugiat metus sodales, ullamcorper tortor non, tristique neque. Ut imperdiet, ante non aliquam varius, quam dui eleifend justo, sit amet aliquet sapien lectus eget velit. Sed vestibulum magna at urna elementum tincidunt. Praesent risus purus, mollis at diam vel, sollicitudin semper felis. Cras tellus leo, sagittis vitae arcu id, fermentum venenatis risus. Donec in risus quis mauris semper lobortis at in lectus.',
            'image' => 'the-walking-dead-the-final-season-screenshot-01-ps4-us-31july2018.jpg'
        ]);
        Post::create([
            'user_id' => 4,
            'title' => 'H1Z1 is a dying game',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim urna mauris, nec tristique lacus euismod sit amet. Pellentesque vulputate neque non ex dapibus suscipit. In sit amet est a erat feugiat mattis. Sed tincidunt mauris sed risus sodales pulvinar ac id nibh. Fusce pulvinar urna libero, vitae pretium nunc tincidunt ac. Integer volutpat ultricies ornare. Fusce bibendum orci convallis cursus fringilla. Nulla facilisi. Quisque eu ullamcorper ex. Duis sit amet turpis massa. Nam feugiat metus sodales, ullamcorper tortor non, tristique neque. Ut imperdiet, ante non aliquam varius, quam dui eleifend justo, sit amet aliquet sapien lectus eget velit. Sed vestibulum magna at urna elementum tincidunt. Praesent risus purus, mollis at diam vel, sollicitudin semper felis. Cras tellus leo, sagittis vitae arcu id, fermentum venenatis risus. Donec in risus quis mauris semper lobortis at in lectus.',
            'image' => 'cz3s8p40jkj01.jpg'
        ]);
        Post::create([
            'user_id' => 5,
            'title' => 'Skyrim Dragon Slaying',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim urna mauris, nec tristique lacus euismod sit amet. Pellentesque vulputate neque non ex dapibus suscipit. In sit amet est a erat feugiat mattis. Sed tincidunt mauris sed risus sodales pulvinar ac id nibh. Fusce pulvinar urna libero, vitae pretium nunc tincidunt ac. Integer volutpat ultricies ornare. Fusce bibendum orci convallis cursus fringilla. Nulla facilisi. Quisque eu ullamcorper ex. Duis sit amet turpis massa. Nam feugiat metus sodales, ullamcorper tortor non, tristique neque. Ut imperdiet, ante non aliquam varius, quam dui eleifend justo, sit amet aliquet sapien lectus eget velit. Sed vestibulum magna at urna elementum tincidunt. Praesent risus purus, mollis at diam vel, sollicitudin semper felis. Cras tellus leo, sagittis vitae arcu id, fermentum venenatis risus. Donec in risus quis mauris semper lobortis at in lectus.',
            'image' => 'DragonCombat.jpg.jpg'
        ]);
        Post::create([
            'user_id' => 5,
            'title' => 'Red Dead Redemption 2',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim urna mauris, nec tristique lacus euismod sit amet. Pellentesque vulputate neque non ex dapibus suscipit. In sit amet est a erat feugiat mattis. Sed tincidunt mauris sed risus sodales pulvinar ac id nibh. Fusce pulvinar urna libero, vitae pretium nunc tincidunt ac. Integer volutpat ultricies ornare. Fusce bibendum orci convallis cursus fringilla. Nulla facilisi. Quisque eu ullamcorper ex. Duis sit amet turpis massa. Nam feugiat metus sodales, ullamcorper tortor non, tristique neque. Ut imperdiet, ante non aliquam varius, quam dui eleifend justo, sit amet aliquet sapien lectus eget velit. Sed vestibulum magna at urna elementum tincidunt. Praesent risus purus, mollis at diam vel, sollicitudin semper felis. Cras tellus leo, sagittis vitae arcu id, fermentum venenatis risus. Donec in risus quis mauris semper lobortis at in lectus.',
            'image' => 'dbc6a0ec921bbfd1e780d963d3fa2dc16ceaa341.jpg'
        ]);
        Post::create([
            'user_id' => 5,
            'title' => 'Far Cry 4',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim urna mauris, nec tristique lacus euismod sit amet. Pellentesque vulputate neque non ex dapibus suscipit. In sit amet est a erat feugiat mattis. Sed tincidunt mauris sed risus sodales pulvinar ac id nibh. Fusce pulvinar urna libero, vitae pretium nunc tincidunt ac. Integer volutpat ultricies ornare. Fusce bibendum orci convallis cursus fringilla. Nulla facilisi. Quisque eu ullamcorper ex. Duis sit amet turpis massa. Nam feugiat metus sodales, ullamcorper tortor non, tristique neque. Ut imperdiet, ante non aliquam varius, quam dui eleifend justo, sit amet aliquet sapien lectus eget velit. Sed vestibulum magna at urna elementum tincidunt. Praesent risus purus, mollis at diam vel, sollicitudin semper felis. Cras tellus leo, sagittis vitae arcu id, fermentum venenatis risus. Donec in risus quis mauris semper lobortis at in lectus.',
            'image' => 'Far-Cry-4-bullshot.jpg'
        ]);
    }
}
