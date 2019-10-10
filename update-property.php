<?php
session_start();
if ($_SESSION) {
    $sjUsers = file_get_contents(__DIR__ . './data/users.json');
    $jUsers = json_decode($sjUsers);
    $loggedInUser = $_SESSION['loggedInUser'];
    $user = $jUsers->$loggedInUser;
    if ($user->role == 'user') {
        header('Location: index');
    } else {
        $sproperties = file_get_contents(__DIR__ . './data/properties.json');
        $properties = json_decode($sproperties);
        $propertyId = $_GET['id'];
        $property = $properties->$propertyId;
    }
} else {
    header('Location: login');
}
require_once(__DIR__ . './components/top.php');
?>
<div class="alert alert-success w-75 m-auto disabled" style="text-align: center;" id="updateBanner" role="alert">
    Property updated succesfuly!
</div>
<div class="d-flex justify-content-center">

    <form class="border border-light p-5 w-50 d-block" method="POST" enctype="multipart/form-data" action="javascript:void(0);" id="propertyUpdateForm">
        <p class="h4 mb-4 text-center">Update property</p>
        <input type="text" name="propertyId" value="<?=$propertyId?>" hidden>
        <div class="d-flex">
            <div class="w-75 mr-2 mb-2">
                <div class="form-group">
                    <label for="propertyStreet">Street</label>
                    <input type="text" id="propertyStreet" class="form-control mb-1" placeholder="Street" value="<?= $property->street ?>" name="propertyStreet" autocomplete="street-address">
                </div>
            </div>
            <div class="w-25 ml-2 mb-2">
                <div class="form-group">
                    <label for="propertyNumber">Number</label>
                    <input type="number" id="propertyNumber" class="form-control mb-1" placeholder="Number" value="<?= $property->number ?>" name="propertyNumber">
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="w-25 mr-2 mb-2">
                <div class="form-group">
                    <label for="propertyPostal">Postal code</label>
                    <input type="number" id="propertyPostal" class="form-control mb-1" placeholder="Postal code" name="propertyPostal" value="<?= $property->postal ?>" autocomplete="postal-code">
                </div>
            </div>
            <div class="w-75 ml-2 mb-2">
                <div class="form-group">
                    <label for="propertyCity">City</label>
                    <input type="text" id="propertyCity" class="form-control mb-1" placeholder="City" value="<?= $property->city ?>" name="propertyCity">
                </div>
            </div>
        </div>
        <div>
            <div class="form-group">
                <label for="propertyPrice">Price</label>
                <input type="number" id="propertyPrice" class="form-control mb-2" placeholder="Price" value="<?= $property->price ?>" name="propertyPrice">
            </div>
        </div>
        <div class="d-flex">
            <div class=" mr-2 mb-2 w-50">
                <div class="form-group">
                    <label for="propertyLatitude">Latitude</label>
                    <input type="text" id="propertyLatitude" class="form-control mb-1" placeholder="Latitude" value="<?= $property->latitude ?>" name="propertyLatitude">
                </div>
            </div>
            <div class=" ml-2 mb-2 w-50">
                <div class="form-group">
                    <label for="propertyLongtitude">Longtitude</label>
                    <input type="text" id="propertyLongtitude" class="form-control mb-1" placeholder="Longtitude" value="<?= $property->longtitude ?>" name="propertyLongtitude">
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class=" mr-2 mb-2" style="width: 33%;">
                <div class="form-group">
                    <label for="propertyBedrooms">Bedrooms</label>
                    <input type="number" id="propertyBedrooms" class="form-control mb-1" placeholder="Bedrooms" value="<?= $property->bedrooms ?>" name="propertyBedrooms">
                </div>
            </div>
            <div class=" ml-1 mr-1 mb-2" style="width: 33%;">
                <div class="form-group">
                    <label for="propertyBathrooms">Bathrooms</label>
                    <input type="number" id="propertyBathrooms" class="form-control mb-1" placeholder="Bathrooms" value="<?= $property->bathrooms ?>" name="propertyBathrooms">
                </div>
            </div>
            <div class=" ml-2 mb-2" style="width: 33%;">
                <div class="form-group">
                    <label for="propertySize">Size</label>
                    <input type="number" id="propertySize" class="form-control mb-1" placeholder="Size" value="<?= $property->size ?>" name="propertySize">

                </div>
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
        <button class="btn btn-info btn-block my-4" id="btnUpdateProperty">Update Property</button>
    </form>
</div>

<?php
require_once(__DIR__ . './components/bottom.php');
?>