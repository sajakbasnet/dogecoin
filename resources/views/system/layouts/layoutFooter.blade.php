<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="{{ asset('compiledCssAndJs/js/system.js')}}"></script>
<script src="{{ asset('toast/jquery.toast.min.js')}}"></script>

<script>
  $(function() {
    var check = `{{$errors->first('success')}}`;
    if (check !== "") {
      $.toast({
        heading: 'Success',
        text: `{{$errors->first('success')}}`,
        showHideTransition: 'plain',
        icon: 'success',
        position: 'bottom-center',
      });
    }

  })
</script>
<script>
  $(".toggle-button").on('click', function() {
    $(".page-wrapper").toggleClass("toggle-page");
  })
</script>