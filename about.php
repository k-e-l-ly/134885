<!DOCTYPE html>
<html>
<head>
    <style>
        .section {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            width: 950px;
        }

        .section img {
            width: 200px;
            height: 200px; /* Set a uniform height for all images */
            margin-right: 30px;
            padding-left: 30px;
        }

        .section h2 {
            text-align: center;
            width: 900px;
            font-size: 24px;
            margin-bottom: 10px;
            padding-right: 20px;
        }

        .section p {
            font-size: 16px;
            line-height: 1.5;
        }

        header {
            text-align: center;
            padding-top: 30px;
            padding-bottom: 30px;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <header>
        <h1>About Eye Cancer Detection</h1>
    </header>
    
    <div class="container">
        <div class="section">
            <img src="what.jpeg" alt="Computer Vision">
            <h2>What is Computer Vision?</h2>
            <p>Computer vision is an interdisciplinary field that enables computers to interpret and understand visual information from the world. It mimics the human visual system, allowing machines to process and analyze images and videos.</p>
        </div>

        <div class="section">
            <img src="how.jpg" alt="Computer Vision Process">
            <h2>How Computer Vision Works</h2>
            <p>Computer vision works by extracting features and patterns from visual data, such as images and videos. It involves image preprocessing, feature extraction, and machine learning algorithms to identify objects, detect anomalies, and make decisions based on visual input.</p>
        </div>

        <div class="section">
            <img src="why.jpeg" alt="Eye Cancer Detection">
            <h2>Why Regular Eye Tests Are Crucial</h2>
            <p>Regular eye tests are essential for early detection of eye diseases, including eye cancer. Timely detection can significantly increase the chances of successful treatment. Our Eye Cancer Detection system leverages computer vision to assist in the early diagnosis and monitoring of eye-related conditions.</p>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>
