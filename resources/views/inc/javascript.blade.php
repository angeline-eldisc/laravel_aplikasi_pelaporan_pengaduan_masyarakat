<script>
    //close the alert after 3 seconds.
    $(document).ready(function(){
    setTimeout(function() {
        $(".alert").alert('close');
    }, 3000);
    });
</script>

<script>
    function readURL() {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(input).prev().attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(function () {
        $(".uploads").change(readURL)
        $("#f").submit(function(){
            return false
        })
    })
</script>