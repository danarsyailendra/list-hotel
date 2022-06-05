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

        //get key for sort
        $keys = array_column($this->hotels, 'AvailableRooms');

        //sort array
        array_multisort($keys, $sort, $this->hotels);

        //get root index of pointer
        $pointer = $this->findIndex($start, $this->hotels, $sort);

        //count limit, if limit more than sum of data then limit = sum of data
        $limit = ($pointer + $limit > count($this->hotels)) ? count($this->hotels) : $pointer + $limit;
        $result_hotel = [];
        $next_start = 0;

        //if root index is not null then loop the data
        if ($pointer !== null) {
            for ($i = $pointer; $i < $limit; $i++) {

                //push data
                $result_hotel[] = $this->hotels[$i];

                //set next start
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
        //if pointer is zero then return zero
        if ($available === 0) {
            return 0;
        }

        //check if pointer is in data
        foreach ($array as $key => $value) {

            //if pointer found
            if ($value['AvailableRooms'] == $available) {

                //check next data available or not
                if (isset($array[$key + 1]['AvailableRooms'])) {

                    //if next data's available room != current available return next data
                    if ($array[$key + 1]['AvailableRooms'] != $value['AvailableRooms']) {
                        return $key + 1;
                    }
                }

            }

        }

        //for case pointer not found in data

        //if sort is desc find room with less than current pointer
        if ($sort == SORT_DESC) {
            foreach ($array as $key => $value) {
                if ($value['AvailableRooms'] < $available) {
                    return $key;
                }

            }
        } else {
            //if sort is desc find room with more than current pointer
            foreach ($array as $key => $value) {
                if ($value['AvailableRooms'] > $available) {
                    return $key;
                }

            }
        }

        //if not meet all scenario
        return null;
    }
}