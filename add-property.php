<?php
session_start();
if ($_SESSION) {
    $sjUsers = file_get_contents(__DIR__ . './data/users.json');
    $jUsers = json_decode($sjUsers);
    $loggedInUser = $_SESSION['loggedInUser'];
    $user = $jUsers->$loggedInUser;
    if($user->role == 'user'){
        header('Location: index');
    }
} else {
    header('Location: login');
}
require_once(__DIR__ . './components/top.php');
?>

<div class="d-flex justify-content-center">

    <form class="border border-light p-5 w-50 d-block" method="POST" enctype="multipart/form-data" id="propertyAddForm">
        <p class="h4 mb-4 text-center">Create property</p>
        <div class="d-flex">
            <div class="w-75 mr-2 mb-2">
                <input type="text" id="propertyStreet" class="form-control mb-1" placeholder="Street" name="propertyStreet" autocomplete="street-address">
            </div>
            <div class="w-25 ml-2 mb-2">
                <input type="number" id="propertyNumber" class="form-control mb-1" placeholder="Number" name="propertyNumber">
            </div>
        </div>
        <div class="d-flex">
            <div class="w-25 mr-2 mb-2">
                <input type="number" id="propertyPostal" class="form-control mb-1" placeholder="Postal code" name="propertyPostal" autocomplete="postal-code">
            </div>
            <div class="w-75 ml-2 mb-2">
                <input type="text" id="propertyCity" class="form-control mb-1" placeholder="City" name="propertyCity">
            </div>
        </div>
        <div>
            <input type="number" id="propertyPrice" class="form-control mb-2" placeholder="Price" name="propertyPrice">
        </div>
        <div class="d-flex">
            <div class=" mr-2 mb-2 w-50">
                <input type="" id="propertyLatitude" class="form-control mb-1" placeholder="Latitude" name="propertyLatitude">
            </div>
            <div class=" ml-2 mb-2 w-50">
                <input type="number" id="propertyLongtitude" class="form-control mb-1" placeholder="Longtitude" name="propertyLongtitude">
            </div>
        </div>
        <div class="d-flex">
            <div class=" mr-2 mb-2" style="width: 33%;">
                <input type="number" id="propertyBedrooms" class="form-control mb-1" placeholder="Bedrooms" name="propertyBedrooms">
            </div>
            <div class=" ml-1 mr-1 mb-2" style="width: 33%;">
                <input type="number" id="propertyBathrooms" class="form-control mb-1" placeholder="Bathrooms" name="propertyBathrooms">
            </div>
            <div class=" ml-2 mb-2" style="width: 33%;">
                <input type="number" id="propertySize" class="form-control mb-1" placeholder="Size" name="propertySize">
            </div>
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="propertyImages" name="propertyImages[]" multiple aria-describedby="inputGroupFileAddon01" style="cursor: pointer;">
                <label class="custom-file-label" for="propertyImages[]">Choose file</label>
            </div>
        </div>

        <div style="text-align: center">
            <p class="error"></p>
        </div>
        <button class="btn btn-info btn-block my-4" id="btnCreateProperty">Create Property</button>
    </form>
</div>

<?php
require_once(__DIR__ . './components/bottom.php');
?>