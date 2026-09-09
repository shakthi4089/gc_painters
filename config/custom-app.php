<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Custom Application Configuration & Key-Value Mappings
    |--------------------------------------------------------------------------
    |
    | Define configurable dropdown options, key-value mappings, GDS sources,
    | property types, project status pipeline options, and painting services.
    |
    */

    'enquiry_statuses' => [
        'New' => 'New Enquiry',
        'Contacted' => 'Contacted / Site Scheduled',
        'Site Visit' => 'Site Visit Completed',
        'Converted' => 'Converted to Project',
        'Closed' => 'Closed / Cancelled',
    ],

    'project_statuses' => [
        'Enquiry' => 'Enquiry Received',
        'Site Visit' => 'Site Visit Completed',
        'Quotation' => 'Quotation Sent',
        'Approved' => 'Work Approved',
        'In Progress' => 'In Progress',
        'Completed' => 'Completed',
    ],

    'property_types' => [
        'House' => 'Independent House / Villa',
        'Apartment' => 'Apartment / Gated Community',
        'Commercial' => 'Commercial Office / Retail',
        'Industrial' => 'Industrial / Epoxy Flooring',
    ],

    'painting_services' => [
        'residential-painting' => 'Residential Interior & Exterior',
        'apartment-painting' => 'Apartment Elevation & Common Area',
        'commercial-painting' => 'Commercial Building Painting',
        'industrial-painting' => 'Industrial & Epoxy Coating',
        'interior-painting' => 'Luxury Interior Finish & Textures',
        'exterior-painting' => 'Exterior Weather Shield Guard',
    ],

    'warranty_periods' => [
        '1-Year' => '1-Year Standard Guarantee',
        '3-Year' => '3-Year Moisture Guard Guarantee',
        '5-Year' => '5-Year Weather Shield Protection',
    ],

    'contact' => [
        'proprietor_label' => 'Proprietor',
        'proprietor_name' => 'M. Gubendran',
        'phone_display' => '+91 89250 14875',
        'phone_raw' => '+918925014875',
        'email' => 'contact@gcpainting.com',
        'address' => 'Anna Nagar & Avadi, Chennai, Tamil Nadu',
        'working_areas' => 'Chennai | Avadi | Ambattur | Velachery | Porur | Tambaram',
        'whatsapp_number' => '918925014875',
        'whatsapp_default_message' => 'Hi GC Painting! I want to get a free quote',
    ],

];
