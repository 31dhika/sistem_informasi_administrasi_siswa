<h4>&nbsp;&nbsp;Stundent Portal SMPN 195 Jakarta</h4>
<hr />


<div class="row-fluid">
    <div class="span4">
        <?php
        if ($this->session->flashdata("login_error")) {
        ?>
            <div class="alert alert-error"><?= $this->session->flashdata("login_error"); ?></div>
        <?php
        }
        ?>
        <form action="<?= base_url("login/proses_login"); ?>" method="post">
            <table>
                <tr>
                    <td>Username</td>
                    <td>: <input type="text" name="username" style="margin-top: 6px;" /></td>
                </tr>
                <tr>
                    <td>Password </td>
                    <td>: <input type="password" name="password" style="margin-top: 6px;" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>&nbsp;&nbsp;<input type="submit" value="Submit" class="btn" /></td>
                </tr>
            </table>
        </form>
        <hr />
        <font size="3">Silahkan Login, untuk masuk ke halaman student portal SMPN 195 JAKARTA</font>
    </div>
    <div class="span8">
        <div class="panel" style="margin-left: -310px;">
            <div class="container">
                <div class="wt-rotator">
                    <div class="screen"></div>
                    <div class="c-panel">
                        <div class="thumbnails">
                            <ul>
                                <li>
                                    <a href="images/component/slide1.jpg" title="temple"><img src="images/component/slide1.jpg" /></a>
                                </li>
                                <li>
                                    <a href="images/component/slide2.jpg" title="temple"><img src="images/component/slide2.jpg" /></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>