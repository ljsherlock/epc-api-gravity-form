<?php 

add_action( 'gform_after_submission_5', 'ljsherlock_after_submission', 10, 2 );

function ljsherlock_after_submission( $entry, $form ) {
    if( $entry['form_id'] == 5 ) {
        // die( print_r( $entry, true ) );
        
        // now we want to send all of this to GHL

        $field_id    = 6;
        $field       = GFFormsModel::get_field( $form, $field_id );
        $benefits = is_object( $field ) ? $field->get_value_export( $entry, $field_id, true ) : '';

        // we also need to read the json
        $addressObj = json_decode($entry[31], true);
        // die(var_dump($addressObj));

        // split full name
        $name_parts = explode(" ", $entry[8]);
        $first_name = $name_parts[0];
        
        // Use end() incase someone adds a middlename.
        $last_name = end($name_parts);;

        $data = [
            "firstName" =>  $first_name,
            "lastName" => $last_name,
            "email" =>  $entry[11],
            "phone" =>  $entry[10],
            "address1" =>  $entry['9.1'],
            "address2" =>  $entry['9.3'],
            "city" =>  $entry['9.2'],
            "state" =>  $entry['9.4'],
            "country" =>  'UK',
            "postalCode" => $entry['9.5'],
            // custom fields
            "energy_rating" =>  $addressObj['current-energy-rating'],
            "local_authority" =>  $addressObj['local-authority-label'],
            "main_fuel" => $addressObj['main-fuel'],
            "heat_type" =>  $addressObj['mainheat-description'],
            "customField" => [
                "energy_rating" =>  $addressObj['current-energy-rating'],
                "local_authority" =>  $addressObj['local-authority-label'],
                "main_fuel" => $addressObj['main-fuel'],
                "property_status" =>  $addressObj['property-type'],
                "heat_type" =>  $addressObj['mainheat-description'],
                "benefits" =>  $benefits,

                // All other EPC fields included.
                'low_energy_fixed_light_count' => $addressObj['low-energy-fixed-light-count'],
                'uprn_source' => $addressObj['uprn-source'],
                'floor_height' => $addressObj['floor-height'],
                'heating_cost_potential' => $addressObj['heating-cost-potential'],
                'unheated_corridor_length' => $addressObj['unheated-corridor-length'],
                'hot_water_cost_potential' => $addressObj['hot-water-cost-potential'],
                'construction_age_band' => $addressObj['construction-age-band'],
                'potential_energy_rating' => $addressObj['potential-energy-rating'],
                'mainheat_energy_eff' => $addressObj['mainheat-energy-eff'],
                'windows_env_eff' => $addressObj['windows-env-eff'],
                'lighting_energy_eff' => $addressObj['lighting-energy-eff'],
                'environment_impact_potential' => $addressObj['environment-impact-potential'],
                'glazed_type' => $addressObj['glazed-type'],
                'heating_cost_current' => $addressObj['heating-cost-current'],
                'mainheatcont_description' => $addressObj['mainheatcont-description'],
                'sheating_energy_eff' => $addressObj['sheating-energy-eff'],
                'fixedlightingoutletscount' => $addressObj['fixed-lighting-outlets-count'],
                'energy_tariff' => $addressObj['energy-tariff'],
                'mechanical_ventilation' => $addressObj['mechanical-ventilation'],
                'hot_water_cost_current' => $addressObj['hot-water-cost-current'],
                'solar_water_heating_flag' => $addressObj['solar-water-heating-flag'],
                'constituency' => $addressObj['constituency'],
                'co2_emissions_potential' => $addressObj['co2-emissions-potential'],
                'number_heated_rooms' => $addressObj['number-heated-rooms'],
                'floor_description' => $addressObj['floor-description'],
                'energy_consumption_potential' => $addressObj['energy-consumption-potential'],
                'built_form' => $addressObj['built-form'],
                'number_open_fireplaces' => $addressObj['number-open-fireplaces'],
                'windows_description' => $addressObj['windows-description'],
                'glazed_area' => $addressObj['glazed-area'],
                'inspection_date' => $addressObj['inspection-date'],
                'mains_gas_flag' => $addressObj['mains-gas-flag'],
                'co2_emiss_curr_per_floor_area' => $addressObj['co2-emiss-curr-per-floor-area'],
                'heat_loss_corridor' => $addressObj['heat-loss-corridor'],
                'flat_storey_count' => $addressObj['flat-storey-count'],
                'constituency_label' => $addressObj['constituency-label'],
                'roof_energy_eff' => $addressObj['roof-energy-eff'],
                'total_floor_area' => $addressObj['total-floor-area'],
                'building_reference_number' => $addressObj['building-reference-number'],
                'environment_impact_current' => $addressObj['environment-impact-current'],
                'co2_emissions_current' => $addressObj['co2-emissions-current'],
                'roof_description' => $addressObj['roof-description'],
                'floor_energy_eff' => $addressObj['floor-energy-eff'],
                'number_habitable_rooms' => $addressObj['number-habitable-rooms'],
                'hot_water_env_eff' => $addressObj['hot-water-env-eff'],
                'mainheatc_energy_eff' => $addressObj['mainheatc-energy-eff'],
                'lighting_env_eff' => $addressObj['lighting-env-eff'],
                'windows_energy_eff' => $addressObj['windows-energy-eff'],
                'floor_env_eff' => $addressObj['floor-env-eff'],
                'sheating_env_eff' => $addressObj['sheating-env-eff'],
                'lighting_description' => $addressObj['lighting-description'],
                'roof_env_eff' => $addressObj['roof-env-eff'],
                'walls_energy_eff' => $addressObj['walls-energy-eff'],
                'photo_supply' => $addressObj['photo-supply'],
                'lighting_cost_potential' => $addressObj['lighting-cost-potential'],
                'mainheat_env_eff' => $addressObj['mainheat-env-eff'],
                'multi_glaze_proportion' => $addressObj['multi-glaze-proportion'],
                'main_heating_controls' => $addressObj['main-heating-controls'],
                'lodgement_datetime' => $addressObj['lodgement-datetime'],
                'flat_top_storey' => $addressObj['flat-top-storey'],
                'secondheat_description' => $addressObj['secondheat-description'],
                'walls_env_eff' => $addressObj['walls-env-eff'],
                'transaction_type' => $addressObj['transaction-type'],
                'uprn' => $addressObj['uprn'],
                'current_energy_efficiency' => $addressObj['current-energy-efficiency'],
                'energy_consumption_current' => $addressObj['energy-consumption-current'],
                'lighting_cost_current' => $addressObj['lighting-cost-current'],
                'lodgement_date' => $addressObj['lodgement-date'],
                'extension_count' => $addressObj['extension-count'],
                'mainheatc_env_eff' => $addressObj['mainheatc-env-eff'],
                'lmk_key' => $addressObj['lmk-key'],
                'wind_turbine_count' => $addressObj['wind-turbine-count'],
                'tenure' => $addressObj['tenure'],
                'floor_level' => $addressObj['floor-level'],
                'potential_energy_efficiency' => $addressObj['potential-energy-efficiency'],
                'hot_water_energy_eff' => $addressObj['hot-water-energy-eff'],
                'low_energy_lighting' => $addressObj['low-energy-lighting'],
                'walls_description' => $addressObj['walls-description'],
                'hotwater_description' => $addressObj['hotwater-description'],
            ]
        ];

        // die(var_dump($data));

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://dbr.fts.mybluehost.me/api-test.php?create-contact',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;
    }
}