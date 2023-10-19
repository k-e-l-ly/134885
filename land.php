<!DOCTYPE html>
<html>
<head>
    <style>
        /* Add CSS for styling the slideshow and animations */
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .slideshow-container {
            position: relative;
            max-height: 100%;
            width: 100%;
            overflow: hidden;
        }

        .mySlides {
            display: none;
            height: 100%;
        }

        .slideshow-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .slideshow-content {
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background: rgba(255, 255, 255, 0.7);
        }

        /* Keyframes animations */
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        .mySlides {
            animation: fadeIn 2s; /* Apply animation to slides */
        }

        /* Style the "Know More" button */
        .info-btn {
            display: inline-block;
            background: #6a57b6;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
	<?php include 'header.php'; ?>

    <div class="slideshow-container">
        <!-- Slide 1 -->
        <div class="mySlides">
            <img class="slideshow-image" src="is.jpg" alt="Guarding Your Vision">
            <div class="slideshow-content">
                <h2>Guarding Your Vision,<br><span>One Scan at a Time</span></h2>
                <p>Welcome to a new era in eye health and early cancer detection. Our mission is to empower individuals
                    with the ability to monitor their eye health conveniently and proactively. By harnessing the power
                    of cutting-edge artificial intelligence, we've developed a system that can analyze eye images to detect
                    potential cancer risks, offering you peace of mind and timely interventions. Your ocular well-being is our priority.</p>
                <a href="about.php" class="info-btn">Know More</a>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="mySlides">
            <img class="slideshow-image" src="cv.jpg" alt="Computer Vision">
            <div class="slideshow-content">
                <h2>Understanding Computer Vision</h2>
                <p>Computer vision is an interdisciplinary field that enables computers to interpret and understand visual information from the world. It mimics the human visual system, allowing machines to process and analyze images and videos.</p>
                <a href="about.php" class="info-btn">Learn More</a>
            </div>
        </div>
    </div>

    <script>
        // Add JavaScript for the slideshow
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let i;
            const slides = document.getElementsByClassName("mySlides");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) { slideIndex = 1 }
            slides[slideIndex - 1].style.display = "block";
            setTimeout(showSlides, 5000); // Change slides every 5 seconds
        }
    </script>

<?php include 'footer.php'; ?>
</body>
</html>
