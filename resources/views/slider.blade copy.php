<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Hello, world!</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">

<style>
    /* Custom styles for the "Next" and "Previous" buttons */
.slick-prev,
.slick-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 1;
    width: 30px; /* Adjust the width as needed */
    height: 30px; /* Adjust the height as needed */
    background-color: #333; /* Background color */
    color: #fff; /* Text color */
    font-size: 18px; /* Font size */
    border: none;
    cursor: pointer;
    opacity: 0.7; /* Opacity on hover */
    transition: opacity 0.3s ease-in-out;
}

/* Hover effect for buttons */
.slick-prev:hover,
.slick-next:hover {
    opacity: 1;
}

</style>

  </head>
  <body>
   
    <div class="container">
        <div class="row mt-5">

        <div class="col-lg-12">
            <div class="text-center">
               <strong>Filter:</strong>     
               <input name="title" id="title" placeholder="search title">  
               <button id="filterButton">Filter</button>   
            </div>    

            <div class="my-slick-slider">
                @foreach($sliders as $slider)
                    <div class="item">
                        <h2>{{ $slider->title }}</h2>
                        <p>{{ $slider->body }}</p>
                    </div>
                @endforeach
            </div>
        </div>     

          <!-- Next and Previous Buttons -->
            <button class="slick-prev">Previous</button>
            <button class="slick-next">Next</button>

        </div>
    </div>     

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

   <!-- Include necessary JavaScript files -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

<script>
    $(document).ready(function () {
        // Initialize the Slick Slider
        $('.my-slick-slider').slick({
            slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                prevArrow: $('.slick-prev'), // Specify the Previous button
                nextArrow: $('.slick-next') // Specify the Next button
        });

        // Handle the filter button click event
        $('#filterButton').click(function () {
            var searchTerm = $('#title').val().trim().toLowerCase();

            // Make an AJAX call to the Laravel route
            $.ajax({
                url: "{{ route('filter.sliders') }}",
                type: "get",
                data: {                  
                    title: searchTerm
                },
                success: function (data) {
                    var sliders = data.sliders;

                    // Clear the existing slider items
                    $('.my-slick-slider').slick('unslick').empty();

                    // Add filtered sliders to the slider
                    $.each(sliders, function (index, slider) {
                        $('.my-slick-slider').append('<div class="item"><h2>' + slider.title + '</h2><p>' + slider.body + '</p></div>');
                    });

                    // Reinitialize the Slick Slider
                    $('.my-slick-slider').slick({
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        autoplay: true,
                        autoplaySpeed: 2000,
                        prevArrow: $('.slick-prev'), // Specify the Previous button
                        nextArrow: $('.slick-next') // Specify the Next button
                    });
                }
            });
        });
        
    });
</script>


</body>
</html>