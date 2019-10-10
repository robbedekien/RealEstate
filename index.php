<?php
require_once(__DIR__ . './components/top.php');
$sproperties = file_get_contents(__DIR__ . '/./data/properties.json');
$properties = json_decode($sproperties);
$sUsers = file_get_contents(__DIR__ . '/./data/users.json');
$users = json_decode($sUsers);
?>



<div class="homeContainer">
    <div id="map">
    </div>
    <div class="properties">
        <?php
        foreach ($properties as $key => $property) {
            $agent = $property->poster;
            createPropertyComponent($property, $users->$agent, $key);
        }
        ?>
    </div>
</div>

<?php

function createPropertyComponent($property, $agent, $key)
{
    ?>
    <div class="property" id="<?= $key ?>">
        <div class="text-center" data-toggle="modal" data-target="#<?= "prop$key" ?>" style="cursor: pointer;">
            <img class="d-flex mr-3 w-100 mainPropertyImage" src="<?= "./assets/images/{$property->images[0]}" ?>" alt="Main property Image" style="border-top-left-radius: 5px; border-top-right-radius: 5px;">
            <h5 class="mt-2 mb-2 font-weight-bold"><?= "$property->street $property->number" ?></h5>
            <hr>
            <h4 style="padding: 0; margin: 0;"><?= '€' . number_format($property->price) ?></h4>
            <hr>
            <div style="display: grid; grid-template-columns: 0.8fr 0.8fr 1.4fr; text-align: center; padding-left: .5em;">
                <p>Bdr: <?= $property->bedrooms ?></p>
                <p>Btr: <?= $property->bathrooms ?></p>
                <p>Size: <?= "$property->size m²" ?></p>
            </div>
        </div>
        <!--Drawer Submit-->
        <div class="modal fade notify" id="<?= "prop$key" ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-full-height modal-right " role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">Property</h4>
                    </div>
                    <div>
                        <img class="d-flex mr-3 w-100 mainPropertyImage" src="<?= "./assets/images/{$property->images[0]}" ?>" alt="Main property Image">
                    </div>
                    <div class="modal-body mx-3">
                        <div class="text-center">
                            <h4><?= "$property->street $property->number" ?></h4>
                            <h5><?= "$property->postal $property->city" ?></h5>
                        </div>
                        <hr>
                        <div class="text-center">
                            <h4><?= '€' . number_format($property->price) ?></h4>
                        </div>
                        <hr>
                        <div class="text-center">
                            <h6><strong>Posted by:</strong> <?= "$agent->firstName $agent->name" ?></h6>
                        </div>
                        <div class="md-form" style="display:grid; grid-template-columns: 1fr 1fr 1fr; text-align: center;">
                            <h6><strong> Bedrooms:</strong> <?= $property->bedrooms ?></h6>
                            <h6><strong> Bathrooms:</strong> <?= $property->bathrooms ?></h6>
                            <h6><strong> Size:</strong> <?= "$property->size m²" ?></h6>
                        </div>
                        <?php
                            if (!empty($_SESSION['loggedInUser'])) {
                                if ($_SESSION['loggedInUser'] == $property->poster) {
                                    ?>
                                <hr>
                                <div class="mb-2" style="justify-content: center; display: flex;">
                                    <a href="update-property.php?id=<?= $key ?>"><button class="btn btn-info mr-1 update" id="update_<?= $key ?>">Update</button></a>
                                    <button class="btn btn-danger delete" id="delete_<?= $key ?>">Delete</button>
                                </div>
                        <?php
                                }
                            }
                            ?>
                        <div style="display:grid; grid-template-columns: 1fr 1fr; width: 100%;">
                            <?php
                                foreach ($property->images as $image) {
                                    ?>
                                <img src="./assets/images/<?= $image ?>" alt="House image" style="width: 100%; padding: 0.1em;">
                            <?php
                                }
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
<script>
    var map;
    var properties = '<?= json_encode($properties) ?>';
    properties = JSON.parse(properties);

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: 55.692355,
                lng: 12.577019
            },
            zoom: 12
        });

        Object.keys(properties).forEach(function(k) {
            var lat = parseFloat(properties[k].latitude);
            var long = parseFloat(properties[k].longtitude);
            var marker = new google.maps.Marker({
                position: {
                    lat: lat,
                    lng: long
                },
                map: map,
                title: `€${properties[k].price}`
            });

            marker.addListener('click', function() {
                console.log()
                $(`#prop${k}`).modal();
            });
        });


    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqpy5qHmJPZk15CrCGURZQQy--Kf4DYmU&callback=initMap&libraries=places"></script>
<?php
require_once(__DIR__ . './components/bottom.php');
?>