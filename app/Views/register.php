<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Register</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5">
            <div class="contact-form">
                <div id="success"></div>
                    <form name="sentMessage" method="post" action="register/simpan" id="contactForm" novalidate="novalidate">
                        <div class="control-group">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username"
                                required="required" data-validation-required-message="Please enter username" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Your password"
                                required="required" data-validation-required-message="Please enter your password" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
