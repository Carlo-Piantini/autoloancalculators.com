<form id="new-car-form">
    <h3 class="form-header"><?php the_field('form_title', 'options'); ?></h3><!--.form-header-->
    <p class="form-description"><?php the_field('form_description', 'options'); ?></p><!--.form-description-->
    <hr/>
    <label class="form-label" for="make-field">
        <span class="form-copy">Select a Make</span>
        <select id="make-field" class="form-input" name="make-field" data-email-label="Make">
            <option value="">Select a Make:</option>
            <option data-model-key="acura_models" value="Acura">Acura</option>
            <option data-model-key="alfa_models" value="Alfa Romeo">Alfa Romeo</option>
            <option data-model-key="aston_models" value="Aston Martin">Astin Martin</option>
            <option data-model-key="audi_models" value="Audi">Audi</option>
            <option data-model-key="bently_models" value="Bently">Bently</option>
            <option data-model-key="bmw_models" value="BMW">BMW</option>
            <option data-model-key="buick_models" value="Buick">Buick</option>
            <option data-model-key="cadillac_models" value="Cadillac">Cadillac</option>
            <option data-model-key="chevrolet_models" value="Chevrolet">Chevrolet</option>
            <option data-model-key="chrysler_models" value="Chrysler">Chrysler</option>
            <option data-model-key="dodge_models" value="Dodge">Dodge</option>
            <option data-model-key="fiat_models" value="FIAT">FIAT</option>
            <option data-model-key="ford_models" value="Ford">Ford</option>
            <option data-model-key="gmc_models" value="GMC">GMC</option>
            <option data-model-key="honda_models" value="Honda">Honda</option>
            <option data-model-key="hyundai_models" value="Hyundai">Hyundai</option>
            <option data-model-key="infiniti_models" value="Infiniti">Infiniti</option>
            <option data-model-key="jaguar_models" value="Jaguar">Jaguar</option>
            <option data-model-key="jeep_models" value="Jeep">Jeep</option>
            <option data-model-key="kia_models" value="Kia">Kia</option>
            <option data-model-key="lamborghini_models" value="Lamborghini">Lamborghini</option>
            <option data-model-key="land_rover_models" value="Land Rover">Land Rover</option>
            <option data-model-key="lexus_models" value="Lexus">Lexus</option>
            <option data-model-key="licoln_models" value="Lincoln">Licoln</option>
            <option data-model-key="maserati_models" value="Maserati">Maserati</option>
            <option data-model-key="mazda_models" value="Mazda">Mazda</option>
            <option data-model-key="mclaren_models" value="McLaren">McLaren</option>
            <option data-model-key="mercedes_models" value="Mercedes-Benz">Mercedes-Benz</option>
            <option data-model-key="mini_models" value="MINI">MINI</option>
            <option data-model-key="mitsubishi_models" value="Mitsubishi">Mitsubishi</option>
            <option data-model-key="nissan_models" value="Nissan">Nissan</option>
            <option data-model-key="porsche_models" value="Porsche">Porsche</option>
            <option data-model-key="ram_models" value="Ram">Ram</option>
            <option data-model-key="rolls_models" value="Rolls-Royce">Rolls-Royce</option>
            <option data-model-key="scion_models" value="Scion">Scion</option>
            <option data-model-key="smart_models" value="smart">smart</option>
            <option data-model-key="subaru_models" value="Subaru">Subaru</option>
            <option data-model-key="toyota_models" value="Toyota">Toyota</option>
            <option data-model-key="volkswagen_models" value="Volkswagen">Volkswagen</option>
            <option data-model-key="volvo_models" value="Volvo">Volvo</option>
        </select><!--#make-field.form-input-->
    </label>
    <label class="form-label" for="model-field">
        <span class="form-copy">Select a Model</span>
        <select id="model-field" class="form-input" disabled data-email-label="Model"></select><!--#make-field.form-input-->
    </label>
    <hr/>
    <label class="form-label" for="car-fname-field">
        <span class="form-copy">First Name</span>
        <input id="car-fname-field" class="form-input" name="car-fname-field" type="text" placeholder="First Name" data-email-label="First Name" /><!--#fname-field.form-input-->
    </label><!--.form-label-->
    <label class="form-label" for="car-lname-field">
        <span class="form-copy">Last Name</span>
        <input id="car-lname-field" class="form-input" name="car-lname-field" type="text" placeholder="Last Name" data-email-label="Last Name" /><!--#lname-field.form-input-->
    </label><!--.form-label-->
    <label class="form-label" for="car-email-field">
        <span class="form-copy">Email</span>
        <input id="car-email-field" class="form-input" name="car-email-field" type="email" placeholder="Email" data-email-label="Email" /><!--#email-field.form-input-->
    </label><!--.form-label-->
    <label class="form-label" for="car-phone-field">
        <span class="form-copy">Phone</span>
        <input id="car-phone-field" class="form-input" name="car-phone-field" type="text" placeholder="Phone" data-email-label="Phone" /><!--#email-field.form-input-->
    </label><!--.form-label-->
    <label class="form-label" for="car-address-field">
        <span class="form-copy">Street Address</span>
        <input id="car-address-field" class="form-input" name="car-address-field" type="text" placeholder="Street Address" data-email-label="Street Address" /><!--#email-field.form-input-->
    </label><!--.form-label-->
    <label class="form-label" for="car-zipcode-field">
        <span class="form-copy">Zip-Code</span>
        <input id="car-zipcode-field" class="form-input" name="car-zipcode-field" type="text" placeholder="Zip-Code" data-email-label="Zip-Code" /><!--#email-field.form-input-->
    </label><!--.form-label-->
    <input class="form-submit" type="submit" value="Submit"><div class="break"></div>
    <img class="loading-icon" src="<?php echo get_template_directory_uri(); ?>/images/animations/loading.gif" alt="Your form submission is currently loading!"/>
    <p class="form-disclaimer"><?php the_field('form_disclaimer', 'options'); ?></p><!--.form-disclaimer-->
</form><!--#new-car-form-->