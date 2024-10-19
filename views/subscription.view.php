<?php require('partials/head.php') ?>
<link rel="stylesheet" href="/assets/css/subscription.css">
<?php require('partials/nav.php') ?>

<div class="container subscription-container">
        <h1>Choose <span>Your Plan</span></h1>
        <div class="price-row">
            <div class="price-column">
                <div class="price-header">
                    <h2>Free</h2>
                    <h3 class="price">0$ <span class="month">/month</span></h3>
                    <ul>
                        <li><span>&#10004;</span> 5 Searches per day</li>
                        <li><span>&#10008;</span> Save Recipes</li>
                    </ul>
                </div>
                <div class="price-footer">
                    <a href="/registration" class="btn">I Want this</a>
                </div>
            </div>
            <div class="price-column">
                <div class="price-header">
                    <h2>Basic</h2>
                    <h3 class="price">5$ <span class="month">/month</span></h3>
                    <ul>
                        <li><span>&#10004;</span> 50 Searches per day</li>
                        <li><span>&#10004;</span> Save Recipes</li>
                        <li><span>&#10004;</span> Save Unlimited</li>
                    </ul>
                </div>
                <div class="price-footer">
                    <a href="#" class="btn">I Want this</a>
                </div>
            </div>
            <div class="price-column">
                <div class="price-header">
                    <h2>Premium</h2>
                    <h3 class="price">10$ <span class="month">/month</span></h3>
                    <ul>
                        <li><span>&#10004;</span> 100 Searches per day</li>
                        <li><span>&#10004;</span> Save Recipes</li>
                        <li><span>&#10004;</span> Save Unlimited</li>
                    </ul>
                </div>
                <div class="price-footer">
                    <a href="#" class="btn">I Want this</a>
                </div>
            </div>
        </div>
    </div>

<?php require('partials/footer.php') ?>