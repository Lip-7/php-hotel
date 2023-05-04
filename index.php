<?php
$hotels = [
  [
    'name' => 'Hotel Belvedere',
    'description' => 'Hotel Belvedere Descrizione',
    'parking' => true,
    'vote' => 4,
    'distance_to_center' => 10.4
  ],
  [
    'name' => 'Hotel Futuro',
    'description' => 'Hotel Futuro Descrizione',
    'parking' => true,
    'vote' => 2,
    'distance_to_center' => 2
  ],
  [
    'name' => 'Hotel Rivamare',
    'description' => 'Hotel Rivamare Descrizione',
    'parking' => false,
    'vote' => 1,
    'distance_to_center' => 1
  ],
  [
    'name' => 'Hotel Bellavista',
    'description' => 'Hotel Bellavista Descrizione',
    'parking' => false,
    'vote' => 5,
    'distance_to_center' => 5.5
  ],
  [
    'name' => 'Hotel Milano',
    'description' => 'Hotel Milano Descrizione',
    'parking' => true,
    'vote' => 2,
    'distance_to_center' => 50
  ],
];
$categories = ['name', 'description', 'parking', 'vote', 'distance to center'];
$filteredHotels = $hotels;

if (!empty($_POST['parking'])) {
  $filteredHotels = [];
  if ($_POST['parking'] == 'all-parking') {
    $filteredHotels = $hotels;
  } elseif ($_POST['parking'] == 'yes-parking') {
    foreach ($hotels as $hotel) {
      if ($hotel['parking']) {
        $filteredHotels[] = $hotel;
      }
    }
  } else {
    foreach ($hotels as $hotel) {
      if (!$hotel['parking']) {
        $filteredHotels[] = $hotel;
      }
    }
  }
  if ($_POST['vote'] != 'all-vote') {
    $filtedByVote = array_filter($hotels, function($val) {
      return $val['vote'] == $_POST['vote'];
    });
    $filteredHotels = $filtedByVote;
  }
}


?>


<!DOCTYPE html>
<!-- <?php ?> -->
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./css/style.css" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="w-full h-screen relative">
  <form action="<?php echo $_SERVER['PHP_SELF']?>" class=" absolute top-5 left-10" method="POST">
    <label for="parkingSelect" class=" text-white">Filter for parking:</label>
    <select name="parking" id="parkingSelect" class=" rounded-lg cursor-pointer px-3 py-1 mr-3">
      <option value="all-parking" class=" cursor-pointer">All</option>
      <option value="yes-parking" class=" cursor-pointer">Yes</option>
      <option value="no-parking" class=" cursor-pointer">No</option>
    </select>
    <label for="voteSelect" class=" text-white">Filter for vote:</label>
    <select name="vote" id="voteSelect" class=" rounded-lg cursor-pointer px-3 py-1 mr-3">
      <option value="all-vote" class=" cursor-pointer">All</option>
      <option value="1" class=" cursor-pointer">1</option>
      <option value="2" class=" cursor-pointer">2</option>
      <option value="3" class=" cursor-pointer">3</option>
      <option value="4" class=" cursor-pointer">4</option>
      <option value="5" class=" cursor-pointer">5</option>
    </select>
    <button class="px-4 py-2 font-semibold text-sm bg-orange-600 text-white rounded-full shadow-sm" type="submit">Search</button>
  </form>
  <div class="tableWrap absolute bottom-4 left-10 p-5">
    <table class="items-center bg-transparent w-full border-collapse text-center text-white">
      <thead>
        <tr>
          <?php foreach ($categories as $categ) { ?>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-black text-left">
              <?php echo $categ ?>
            </th>
          <?php } ?>
          <!-- <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
            Visitors
          </th>
          <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
            Unique users
          </th>
          <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
            Bounce rate
          </th> -->
        </tr>
      </thead>

      <tbody>
        <?php foreach ($filteredHotels as $hotel) { ?>
          <tr>
            <?php foreach ($hotel as $key => $info) { ?>
              <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                <?php if ($key != 'parking') {
                  echo $info;
                } else {
                  if ($info == true) {
                    echo "Yes";
                  } else {
                    echo "No";
                  }
                }
                ?>
              </td>
            <?php } ?>
          </tr>
        <?php } ?>
        <!-- <tr>
          <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">
            /argon/
          </th>
          <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 ">
            4,569
          </td>
          <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            340
          </td>
          <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            <i class="fas fa-arrow-up text-emerald-500 mr-4"></i>
            46,53%
          </td>
        </tr>
        <tr>
          <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700">
            /argon/index.html
          </th>
          <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            3,985
          </td>
          <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            319
          </td>
          <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            <i class="fas fa-arrow-down text-orange-500 mr-4"></i>
            46,53%
          </td>
        </tr>
        <tr>
          <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700">
            /argon/charts.html
          </th>
          <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            3,513
          </td>
          <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            294
          </td>
          <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            <i class="fas fa-arrow-down text-orange-500 mr-4"></i>
            36,49%
          </td>
        </tr>
        <tr>
          <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700">
            /argon/tables.html
          </th>
          <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            2,050
          </td>
          <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            147
          </td>
          <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            <i class="fas fa-arrow-up text-emerald-500 mr-4"></i>
            50,87%
          </td>
        </tr>
        <tr>
          <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700">
            /argon/profile.html
          </th>
          <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            1,795
          </td>
          <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            190
          </td>
          <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            <i class="fas fa-arrow-down text-red-500 mr-4"></i>
            46,53%
          </td>
        </tr> -->
      </tbody>

    </table>
  </div>

  <script src="./js/utility.js"></script>
  <script src="./js/script.js"></script>
</body>

</html>