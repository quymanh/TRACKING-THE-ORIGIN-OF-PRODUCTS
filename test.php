<script src="js/DecoderWorker.js"></script>
<script src="js/exif.js"></script>
<script src="js/BarcodeReader.js"></script>
<form action="#">
  <input id="searchBarCode" type="file" accept="image/*;capture=camera">
</form>
<script>
  BarcodeReader.Init();
  BarcodeReader.SetImageCallback(function(result) {
    console.dir(result);
    if (!result.length) {
      alert('could not read barcode');
      return;
    }

    var barcode = result[0];
    alert("Format: " + barcode.Format + " Value: " + barcode.Value);
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