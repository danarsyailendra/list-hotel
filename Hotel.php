<?php

class Hotel
{
    public array $hotels;

    public function __construct()
    {
        $this->hotels = [
            [
                "HotelID" => 2,
                "Name" => "Hotel Gumilang",
                "AvailableRooms" => 200
            ],
            [
                "HotelID" => 4,
                "Name" => "Hotel Safari",
                "AvailableRooms" => 150
            ],
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
            [
                "HotelID" => 3,
                "Name" => "Hotel Aston",
                "AvailableRooms" => 450
            ],
            [
                "HotelID" => 6,
                "Name" => "Hotel Amarsya",
                "AvailableRooms" => 150
            ],
            [
                "HotelID" => 7,
                "Name" => "Hotel Parama",
                "AvailableRooms" => 200
            ],
            [
                "HotelID" => 8,
                "Name" => "Hotel Rancamaya",
                "AvailableRooms" => 400
            ],
            [
                "HotelID" => 9,
                "Name" => "Hotel Palace",
                "AvailableRooms" => 300
            ],
        ];
    }

    public function listHotels($start, $limit, $sort = "desc")
    {
        $sort = ($sort == "asc") ? SORT_ASC : SORT_DESC;
        $keys = array_column($this->hotels, 'AvailableRooms');
        array_multisort($keys, $sort, $this->hotels);
        $pointer = $this->findIndex($start, $this->hotels, $sort);
        $limit = ($pointer + $limit > count($this->hotels)) ? count($this->hotels) : $pointer + $limit;
        $result_hotel = [];
        $next_start = 0;
        if ($pointer !== null) {
            for ($i = $pointer; $i < $limit; $i++) {
                $result_hotel[] = $this->hotels[$i];
                $next_start = $this->hotels[$i]['AvailableRooms'];

            }
        }

        $result = [
            "NextStart" => $next_start,
            "Hotels" => $result_hotel
        ];
        return json_encode($result);
    }

    private function findIndex($available, $array, $sort)
    {
        if ($available === 0) {
            return 0;
        }


        foreach ($array as $key => $value) {
            if ($value['AvailableRooms'] == $available) {
                if (isset($array[$key + 1]['AvailableRooms'])) {
                    if ($array[$key + 1]['AvailableRooms'] != $value['AvailableRooms']) {
                        return $key + 1;
                    }
                }

            }

        }

        if ($sort == SORT_DESC) {
            foreach ($array as $key => $value) {
                if ($value['AvailableRooms'] < $available) {
                    return $key;
                }

            }
        } else {
            foreach ($array as $key => $value) {
                if ($value['AvailableRooms'] > $available) {
                    return $key;
                }

            }
        }
        return null;
    }
}