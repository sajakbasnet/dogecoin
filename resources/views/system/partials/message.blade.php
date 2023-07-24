@if( ($errors->first('alert-success') || $errors->first('alert-danger') || $errors->first('alert-warning')))
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if($errors->has('alert-' . $msg))
            <div class="alert alert-{{ $msg }}" style="width: 100%;">
                <p style="margin-bottom: 0px;">{{translate($errors->first('alert-' .$msg))}}<a href="#" class="close"
                                                                                               data-dismiss="alert"
                                                                                               aria-label="close">&times;</a>
                </p>
            </div>
        @endif
    @endforeach
@elseif($errors->first('alert-throttle'))
    <div class="alert alert-danger" id="alert-throttle" style="width: 100%;">
        <p style="margin-bottom: 0px;">{{$errors->first('alert-throttle')}}
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        </p>
    </div>
@endif

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    const error = {{isset($errors) && $errors->first('alert-throttle') ?? ''}};

    if (error !== '') {
        var seconds = {{session('seconds') ?? 0}}; // Default value 0 if $seconds is not set

        function updateCountdown() {
            $('#alert-throttle').text('Too many attempts. Please try again after ' + seconds + ' seconds');

            if (seconds === 0) {
                clearInterval(countdownInterval); // Clear the interval when seconds reach 0
                $('#alert-throttle').hide();
            } else {
                seconds--;
            }
        }

        updateCountdown(); // Call the function initially

        var countdownInterval = setInterval(updateCountdown, 1000); // Run the countdown every 1000 milliseconds (1 second)
    }
</script>
