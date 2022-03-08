<?php

namespace Test;

use App\HelloController;
use App\PositionController;
use PHPUnit\Framework\TestCase;

class PositionControllerTest extends TestCase
{

    public function test_coord_are_displayed(){
        $_GET['latitude'] = '1';
        $_GET['longitude'] = '1';

        $controller = new PositionController( $_GET['latitude'],  $_GET['longitude']);

        $response = $controller->displayForm();

        $this->assertStringContainsString("1", $response->getContent());

        $this->assertEquals(200, $response->getStatusCode());

        $content_type = ($response->getHeaders())['Content-Type'] ?? null;

        $this->assertEquals('text/html', $content_type);
    }

    public function test_North_hemisphere_is_determinated(){
        $_GET['latitude'] = '1';
        $_GET['longitude'] = '1';

        $controller = new PositionController( $_GET['latitude'],  $_GET['longitude']);

        $response = $controller->displayForm();

        $this->assertStringContainsString("Nord", $response->getContent());

    }

    public function test_South_hemisphere_is_determinated(){
        $_GET['latitude'] = '-1';
        $_GET['longitude'] = '1';

        $controller = new PositionController( $_GET['latitude'],  $_GET['longitude']);

        $response = $controller->displayForm();

        $this->assertStringContainsString("Sud", $response->getContent());

    }



}