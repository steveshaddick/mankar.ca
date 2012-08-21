<div id="secLogin">
        <h1>Please log in</h1>
        <form id="frmLogin" action="/simple-cms/login" method="POST">
            
        	<?php
        	if ($auth->failed) {
        		?>

        		<p class="loginFail">Login failed</p>

        		<?php
        	}
        	?>
            <fieldset>

                <span class="formLabel">Username:</span>
                <input id="txtUsername" name="txtUsername" type="text" maxlength="100" class="inputText" value="" title="Username" placeholder="Username" autofocus required/><br />
                <span class="formLabel">Password:</span>
                <input id="txtPassword" name="txtPassword" type="password" maxlength="20" class="inputText" title="Password" placeholder="Password" required/><br />
                <br />
                <span class="formLabel">Remember me:</span><input name="chkRemember" type="checkbox"  value="true"/><br />
                <br />
                <input type="submit" value="Log In" /> 
            </fieldset> 
        </form>
</div>