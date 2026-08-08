<h2>Log In</h2>

<?php if (isset($error)): ?>
    <div style="color: red; padding: 10px; border: 1px solid red; margin-bottom: 15px;">
        <?php echo $error; ?>
    </div>
<?php endif; ?>

<form action="" method="post">
    <div>
        <label for="email">Email Address:</label><br>
        <input type="email" id="email" name="email" required>
    </div>
    
    <div style="margin-top: 10px;">
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required>
    </div>
    
    <div style="margin-top: 15px;">
        <input type="submit" name="login" value="Log In">
    </div>
</form>