<?php

use PHPUnit\Framework\TestCase;

require_once "Hotel.php";

class TestHotel extends TestCase
{
    public function testStartZero()
    {
        $hotel = new Hotel();
        $list = $hotel->listHotels(0, 2, "desc");
        $result = json_encode([
            "NextStart" => 450,
            "Hotels" => [
                [
                    "HotelID" => 1,
                    "Name" => "Hotel Indonesia",
                    "AvailableRooms" => 500
                ],
                [
                    "HotelID" => 3,
                    "Name" => "Hotel Aston",
                    "AvailableRooms" => 450
                ],
            ]
        ]);
        $this->assertJsonStringEqualsJsonString($result, $list);
    }

    public function testStartNegative()
    {
        $hotel = new Hotel();
        $list = $hotel->listHotels(-1, 2, "desc");
        $result = json_encode([
            "NextStart" => 0,
            "Hotels" => []
        ]);
        $this->assertJsonStringEqualsJsonString($result, $list);
    }

    public function testStartInArray()
    {
        $hotel = new Hotel();
        $list = $hotel->listHotels(300, 2, "desc");
        $result = json_encode([
            "NextStart" => 200,
            "Hotels" => [
                [
                    "HotelID" => 2,
                    "Name" => "Hotel Gumilang",
                    "AvailableRooms" => 200
                ],
                [
                    "HotelID" => 7,
                    "Name" => "Hotel Parama",
                    "AvailableRooms" => 200
                ],
            ]
        ]);
        $this->assertJsonStringEqualsJsonString($result, $list);
    }

    public function testStartNotInArray()
    {
        $hotel = new Hotel();
        $list = $hotel->listHotels(301, 2, "desc");
        $result = json_encode([
            "NextStart" => 200,
            "Hotels" => [
                [
                    "HotelID" => 9,
                    "Name" => "Hotel Palace",
                    "AvailableRooms" => 300
                ],
                [
                    "HotelID" => 2,
                    "Name" => "Hotel Gumilang",
                    "AvailableRooms" => 200
                ],
            ]
        ]);
        $this->assertJsonStringEqualsJsonString($result, $list);
    }

    public function testStartMoreThanAvailableRooms()
    {
        $hotel = new Hotel();
        $list = $hotel->listHotels(600, 2, "desc");
        $result = json_encode([
            "NextStart" => 450,
            "Hotels" => [
                [
                    "HotelID" => 1,
                    "Name" => "Hotel Indonesia",
                    "AvailableRooms" => 500
                ],
                [
                    "HotelID" => 3,
                    "Name" => "Hotel Aston",
                    "AvailableRooms" => 450
                ],
            ]
        ]);
        $this->assertJsonStringEqualsJsonString($result, $list);
    }

    public function testLimitInRange()
    {
        $hotel = new Hotel();
        $list = $hotel->listHotels(0, 2, "desc");
        $result = json_encode([
            "NextStart" => 450,
            "Hotels" => [
                [
                    "HotelID" => 1,
                    "Name" => "Hotel Indonesia",
                    "AvailableRooms" => 500
                ],
                [
                    "HotelID" => 3,
                    "Name" => "Hotel Aston",
                    "AvailableRooms" => 450
                ],
            ]
        ]);
        $this->assertJsonStringEqualsJsonString($result, $list);
    }

    public function testLimitNegative()
    {
        $hotel = new Hotel();
        $list = $hotel->listHotels(400, -1, "desc");
        $result = json_encode([
            "NextStart" => 0,
            "Hotels" => []
        ]);
        $this->assertJsonStringEqualsJsonString($result, $list);
    }

    public function testLimitMoreThanData()
    {
        $hotel = new Hotel();
        $list = $hotel->listHotels(200, 100, "desc");
        $result = json_encode([
            "NextStart" => 150,
            "Hotels" => [
                [
                    "HotelID" => 4,
                    "Name" => "Hotel Safari",
                    "AvailableRooms" => 150
                ],
                [
                    "HotelID" => 6,
                    "Name" => "Hotel Amarsya",
                    "AvailableRooms" => 150
                ],
            ]
        ]);
        $this->assertJsonStringEqualsJsonString($result, $list);
    }

    public function testSortNull()
    {
        $hotel = new Hotel();
        $list = $hotel->listHotels(200, 2);
        $result = json_encode([
            "NextStart" => 150,
            "Hotels" => [
                [
                    "HotelID" => 4,
                    "Name" => "Hotel Safari",
                    "AvailableRooms" => 150
                ],
                [
                    "HotelID" => 6,
                    "Name" => "Hotel Amarsya",
                    "AvailableRooms" => 150
                ],
            ]
        ]);
        $this->assertJsonStringEqualsJsonString($result, $list);
    }

    public function testSortDesc()
    {
        $hotel = new Hotel();
        $list = $hotel->listHotels(300, 2, "desc");
        $result = json_encode([
            "NextStart" => 200,
            "Hotels" => [
                [
                    "HotelID" => 2,
                    "Name" => "Hotel Gumilang",
                    "AvailableRooms" => 200
                ],
                [
                    "HotelID" => 7,
                    "Name" => "Hotel Parama",
                    "AvailableRooms" => 200
                ],
            ]
        ]);
        $this->assertJsonStringEqualsJsonString($result, $list);
    }

    public function testSortAsc()
    {
        $hotel = new Hotel();
        $list = $hotel->listHotels(250, 2, "asc");
        $result = json_encode([
            "NextStart" => 400,
            "Hotels" => [
                [
                    "HotelID" => 9,
                    "Name" => "Hotel Palace",
                    "AvailableRooms" => 300
                ],
                [
                    "HotelID" => 8,
                    "Name" => "Hotel Rancamaya",
                    "AvailableRooms" => 400
                ],
            ]
        ]);
        $this->assertJsonStringEqualsJsonString($result, $list);
    }


}