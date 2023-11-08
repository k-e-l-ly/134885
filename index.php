<?php include 'header.php'; ?>

<style>
    /* Reset some default styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Basic styles for body and fonts */
body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    color: #333;
}

.container {
    max-width: 960px;
    margin: 0 auto;
    padding: 20px;
}

/* Header styles */
header {
    background-color: #333;
    color: #fff;
    padding: 10px 0;
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

nav a {
    color: #fff;
    text-decoration: none;
    margin: 0 20px;
}

/* Above the Fold Section */
.above-fold {
    background: url('your-background-image.jpg') center/cover no-repeat;
    text-align: center;
    padding: 100px 0;
    color: #fff;
}

.above-fold h1 {
    font-size: 36px;
    margin-bottom: 20px;
}

.above-fold p {
    font-size: 18px;
    margin-bottom: 40px;
}

.above-fold button {
    background-color: #007BFF;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
}

/* Below the Fold Section */
.below-fold h2 {
    font-size: 28px;
    margin-top: 40px;
}

.below-fold ul {
    list-style: disc;
    margin-left: 20px;
}

.testimonial {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

.testimonial blockquote {
    font-style: italic;
    font-size: 20px;
}

.testimonial p {
    font-weight: 600;
    font-size: 16px;
    margin-top: 10px;
}

</style>

<section class="above-fold">
    <!-- Content about what the system does -->
    <h1>Welcome to Our System</h1>
    <p>Learn how our system can simplify your life.</p>
    <a href="#benefits">Learn More</a>
</section>

<section id="benefits" class="below-fold">
    <!-- Benefits of the system -->
    <h2>Benefits of Our System</h2>
    <div class="benefits">
        <div class="benefit">
            <h3>Benefit 1</h3>
            <p>Description of benefit 1.</p>
        </div>
        <div class="benefit">
            <h3>Benefit 2</h3>
            <p>Description of benefit 2.</p>
        </div>
        <div class="benefit">
            <h3>Benefit 3</h3>
            <p>Description of benefit 3.</p>
        </div>
    </div>

    <!-- Features of the system -->
    <h2>Features</h2>
    <div class="features">
        <div class="feature">
            <h3>Feature 1</h3>
            <p>Description of feature 1.</p>
        </div>
        <div class="feature">
            <h3>Feature 2</h3>
            <p>Description of feature 2.</p>
        </div>
        <div class="feature">
            <h3>Feature 3</h3>
            <p>Description of feature 3.</p>
        </div>
    </div>

    <!-- Testimonials -->
    <h2>Testimonials</h2>
    <div class="testimonials">
        <div class="testimonial">
            <p>"I love this system! It saved me time and effort."</p>
            <p>- John Doe</p>
        </div>
        <div class="testimonial">
            <p>"The best system I've ever used."</p>
            <p>- Jane Smith</p>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
