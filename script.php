<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Material Design Bootstrap-->
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/mdb.min.js"></script>

<script src="web3.min.js"></script>
<script src="app.js"></script>
<script type="text/javascript" src="js/jquery.simplePagination.js"></script>
<script type="text/javascript" src="js/paginationCss.js"></script>
<script src="js/DecoderWorker.js"></script>
<script src="js/exif.js"></script>
<script src="js/BarcodeReader.js"></script>
<script>
    BarcodeReader.Init();
    BarcodeReader.SetImageCallback(function(result) {
        result.value = "";
        if (!result.length) {
            $('#ErrorBarCode').modal('show');
            return;
        } else {
            var barcode = result[0];
            document.getElementById("searchText").value = barcode.Value;
            document.getElementById('searchButton').click();
        }

    });
    document.querySelector('input[id="searchBarCode"]')
        .addEventListener('change',
            function(evt) {
                var file = evt.target.files[0]
                reader = new FileReader();

                reader.onloadend = function() {
                    var img = new Image();
                    img.src = reader.result;
                    BarcodeReader.DecodeImage(img);
                }

                reader.readAsDataURL(file);
            },
            false
        );
</script>