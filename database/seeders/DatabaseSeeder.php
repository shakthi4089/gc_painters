<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Enquiry;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\ProjectUpdate;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\Testimonial;
use App\Models\Gallery;
use App\Models\WebsiteSetting;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ensure public/images directory exists and create demo SVG images
        $imgDir = public_path('images');
        if (!File::exists($imgDir)) {
            File::makeDirectory($imgDir, 0755, true);
        }

        $this->generateSvgImages($imgDir);

        // 2. Seed Users & Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@gcprojects.com'],
            [
                'name' => 'GC Admin (Chandran)',
                'phone' => '8925014875',
                'role' => 'admin',
                'address' => 'No. 45, Main Road, Chennai',
                'password' => Hash::make('password'),
            ]
        );

        $demoUser = User::updateOrCreate(
            ['email' => 'ramesh@example.com'],
            [
                'name' => 'Ramesh Kumar',
                'phone' => '9840123456',
                'role' => 'customer',
                'address' => 'Flat 4B, Royal Apartments, Anna Nagar, Chennai',
                'password' => Hash::make('password'),
            ]
        );

        // 3. Seed Customers
        $customerRamesh = Customer::create([
            'user_id' => $demoUser->id,
            'name' => 'Ramesh Kumar',
            'phone' => '9840123456',
            'email' => 'ramesh@example.com',
            'location' => 'Chennai',
            'address' => 'Flat 4B, Royal Apartments, Anna Nagar, Chennai',
            'notes' => 'Looking for complete exterior weather coating for 4-story building.',
        ]);

        $customerKumar = Customer::create([
            'name' => 'Kumar Swamy',
            'phone' => '9790112233',
            'email' => 'kumar@gmail.com',
            'location' => 'Avadi',
            'address' => 'Plot 12, Green Avenue, Avadi, Chennai',
            'notes' => 'Requires interior emulsion painting with royal texture wall in living room.',
        ]);

        $customerABC = Customer::create([
            'name' => 'ABC Pvt Ltd (Manager Anand)',
            'phone' => '9444001122',
            'email' => 'facilities@abcpvtltd.com',
            'location' => 'Ambattur Industrial Estate',
            'address' => 'Phase 2, Ambattur Industrial Estate, Chennai',
            'notes' => 'Commercial warehouse epoxy floor and exterior weathercoat.',
        ]);

        $customerPriya = Customer::create([
            'name' => 'Dr. Priya Seshadri',
            'phone' => '9884556677',
            'email' => 'priya.s@gmail.com',
            'location' => 'Velachery',
            'address' => 'Villa #8, Sunshine Enclave, Velachery',
            'notes' => 'Complete Villa Interior & Exterior repainting.',
        ]);

        // 4. Seed Services
        $serviceRes = Service::create([
            'title' => 'Residential Painting',
            'slug' => 'residential-painting',
            'subtitle' => 'Premium interior & exterior solutions for independent houses & villas',
            'category' => 'Residential',
            'short_description' => 'Transform your home with vibrant, long-lasting paints, smooth finishes, and crack-proof wall treatments.',
            'full_description' => 'Our residential painting service covers everything from surface preparation, wall putty smoothing, moisture seal priming, to final coats of low-VOC premium paints. We handle independent houses, duplex villas, and bungalows with precision and dust-free execution.',
            'icon' => 'fa-house-chimney',
            'cover_image' => 'images/service_residential.svg',
            'features' => ['Dust-free sanding', 'Waterproof priming', 'Color consultation', 'Asian Paints Apex & Royale'],
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        $serviceApt = Service::create([
            'title' => 'Apartment Painting',
            'slug' => 'apartment-painting',
            'subtitle' => 'Large-scale exterior & interior painting for residential complexes',
            'category' => 'Apartment',
            'short_description' => 'Specialized scaffolding, high-reach weather protection, and uniform aesthetic coatings for multi-story apartments.',
            'full_description' => 'We specialize in exterior repainting for multi-story apartment complexes and housing societies. Equipped with safety gear, heavy-duty scaffolding, and weather-proof elastomeric paints, we protect your complex against heavy monsoon moisture and sun damage.',
            'icon' => 'fa-building-user',
            'cover_image' => 'images/service_apartment.svg',
            'features' => ['Safety certified scaffolding', 'Anti-fungal weather shield', 'Society committee reporting', '5-Year Warranty'],
            'is_featured' => true,
            'sort_order' => 2,
        ]);

        $serviceComm = Service::create([
            'title' => 'Commercial Painting',
            'slug' => 'commercial-painting',
            'subtitle' => 'Professional interior & exterior branding for offices, IT parks & retail',
            'category' => 'Commercial',
            'short_description' => 'Fast-turnaround painting for corporate offices, IT parks, retail shops, and commercial complexes.',
            'full_description' => 'We understand business timelines. Our team works night shifts and weekends to deliver pristine office interiors, corporate brand color matching, acoustic ceiling painting, and exterior curtain wall touchups without disrupting business operations.',
            'icon' => 'fa-briefcase',
            'cover_image' => 'images/service_commercial.svg',
            'features' => ['Off-hours execution', 'Odourless zero-VOC paint', 'Brand color accuracy', 'Commercial durability'],
            'is_featured' => true,
            'sort_order' => 3,
        ]);

        $serviceInd = Service::create([
            'title' => 'Industrial Painting',
            'slug' => 'industrial-painting',
            'subtitle' => 'Heavy-duty epoxy coatings, anti-corrosive & heat resistant finishes',
            'category' => 'Industrial',
            'short_description' => 'Protective coating solutions for factories, warehouses, steel structures, and chemical plants.',
            'full_description' => 'Industrial environments demand extreme resilience. We apply high-build epoxy floor coatings, poly-urethane anti-corrosive primers for steel trusses, heat-resistant stack coatings, and floor demarcation lines in compliance with industrial safety standards.',
            'icon' => 'fa-industry',
            'cover_image' => 'images/service_industrial.svg',
            'features' => ['Epoxy floor coating', 'Anti-corrosive primer', 'Structural steel protection', 'Safety floor marking'],
            'is_featured' => true,
            'sort_order' => 4,
        ]);

        $serviceInt = Service::create([
            'title' => 'Interior Painting',
            'slug' => 'interior-painting',
            'subtitle' => 'Smooth wall finishes, metallic textures & designer accent walls',
            'category' => 'Interior',
            'short_description' => 'Elevate your living space with velvet sheen emulsions, stencil designs, and royal metallic texture walls.',
            'full_description' => 'Turn your walls into art pieces. We offer acrylic wall putty leveling, ceiling waterproofing, washable luxury emulsions, metallic accent walls, and wood polish for doors and windows.',
            'icon' => 'fa-paint-roller',
            'cover_image' => 'images/service_interior.svg',
            'features' => ['Washable velvet finish', 'Royal texture accent walls', 'Wood & door PU polish', 'Zero mess protection'],
            'is_featured' => true,
            'sort_order' => 5,
        ]);

        $serviceExt = Service::create([
            'title' => 'Exterior Painting',
            'slug' => 'exterior-painting',
            'subtitle' => 'Weatherproof, UV-resistant & damp-proof exterior wall coatings',
            'category' => 'Exterior',
            'short_description' => 'Shield your property from severe weather, monsoon algae growth, and wall cracks with heavy-duty exterior coats.',
            'full_description' => 'Exterior walls endure extreme weather. Our 4-layer exterior system includes pressure washing, crack bridging sealer, waterproof primer, and elastomeric weather-shield topcoats guaranteed to stay bright for years.',
            'icon' => 'fa-sun',
            'cover_image' => 'images/service_exterior.svg',
            'features' => ['Pressure washing cleanup', 'Crack sealant filler', 'UV protection shield', 'Anti-algae technology'],
            'is_featured' => true,
            'sort_order' => 6,
        ]);

        // 5. Seed Projects & Photos
        $project1 = Project::create([
            'customer_id' => $customerRamesh->id,
            'service_id' => $serviceApt->id,
            'title' => 'Apartment Exterior Weather Protection & Repainting',
            'slug' => 'apartment-exterior-painting-chennai',
            'property_type' => 'Apartment',
            'painting_type' => 'Exterior',
            'location' => 'Anna Nagar, Chennai',
            'area_sqft' => '25,000 sq.ft',
            'year_completed' => '2026',
            'work_details' => 'Full exterior elastomeric weather shield coating, crack filling & damp seal treatment for 4-story block',
            'description' => 'A major residential apartment elevation transformation in Chennai. The building had faded paint, monsoon algae staining, and hairline cracks. Our team erected heavy safety scaffolding, pressure-washed all surfaces, applied elastomeric damp-proof sealers, and finished with a 2-tone modern off-white and deep azure accent coat.',
            'start_date' => '2026-08-01',
            'expected_end_date' => '2026-09-15',
            'status' => 'In Progress',
            'progress_percent' => 75,
            'total_amount' => 485000.00,
            'paid_amount' => 350000.00,
            'cover_image' => 'images/project1_after.svg',
            'is_featured' => true,
            'show_before_after' => true,
            'team_supervisor' => 'G. Chandran (Master Painter)',
            'materials_used' => 'Asian Paints Apex Ultima Protek, Damp Proof Sealer, Crack Seal Paste, Asian Paints Rust Shield',
            'admin_notes' => 'Final coat of accent borders in progress on East Facing block. Completion expected next week.',
        ]);

        ProjectImage::create(['project_id' => $project1->id, 'image_path' => 'images/project1_before.svg', 'type' => 'before', 'caption' => 'Faded exterior with monsoon water damage before painting', 'sort_order' => 1]);
        ProjectImage::create(['project_id' => $project1->id, 'image_path' => 'images/project1_during.svg', 'type' => 'during', 'caption' => 'Scaffolding & waterproof primer coat application', 'sort_order' => 2]);
        ProjectImage::create(['project_id' => $project1->id, 'image_path' => 'images/project1_after.svg', 'type' => 'after', 'caption' => 'Vibrant modern exterior elevation with weather guard finish', 'sort_order' => 3]);

        ProjectUpdate::create(['project_id' => $project1->id, 'title' => 'Surface Washing & Crack Sealing Complete', 'description' => 'High pressure water jetting removed all moss and dirt. Applied polyurethane crack sealers across all exterior walls.', 'progress_percent' => 30, 'photo' => 'images/project1_during.svg']);
        ProjectUpdate::create(['project_id' => $project1->id, 'title' => 'Waterproof Base Primer Coat Applied', 'description' => 'First coat of Asian Paints Damp Proof Sealer applied on East & West facing elevations.', 'progress_percent' => 55, 'photo' => 'images/project1_during.svg']);
        ProjectUpdate::create(['project_id' => $project1->id, 'title' => 'Topcoat 1 Applied & Accent Trim Work', 'description' => 'Main off-white Ultima Protek topcoat completed. Currently painting balcony railings and azure window trims.', 'progress_percent' => 75, 'photo' => 'images/project1_after.svg']);

        $project2 = Project::create([
            'customer_id' => $customerKumar->id,
            'service_id' => $serviceRes->id,
            'title' => 'Luxury Duplex Villa Complete Interior & Exterior',
            'slug' => 'luxury-villa-painting-avadi',
            'property_type' => 'House',
            'painting_type' => 'Both',
            'location' => 'Avadi, Chennai',
            'area_sqft' => '4,500 sq.ft',
            'year_completed' => '2026',
            'work_details' => 'Living room Royale Play metallic texture, ceiling polish, doors PU lacquer, and exterior anti-fungal coat',
            'description' => 'A comprehensive home makeover for a modern duplex villa in Avadi. Included custom gold-metallic texture accent wall in the main double-height hall, teakwood main door lacquer polishing, and premium washable interior emulsion throughout.',
            'start_date' => '2026-06-10',
            'expected_end_date' => '2026-07-20',
            'completed_date' => '2026-07-18',
            'status' => 'Completed',
            'progress_percent' => 100,
            'total_amount' => 175000.00,
            'paid_amount' => 175000.00,
            'cover_image' => 'images/project2_after.svg',
            'is_featured' => true,
            'show_before_after' => true,
            'team_supervisor' => 'K. Murugan',
            'materials_used' => 'Asian Paints Royale Luxury Emulsion, Royale Play Metallic Stencil, PU Teak Lacquer',
            'admin_notes' => 'Project completed 2 days ahead of schedule. Customer delivered excellent 5-star review.',
        ]);

        ProjectImage::create(['project_id' => $project2->id, 'image_path' => 'images/project2_before.svg', 'type' => 'before', 'caption' => 'Old yellowish walls with surface stains before restoration', 'sort_order' => 1]);
        ProjectImage::create(['project_id' => $project2->id, 'image_path' => 'images/project2_after.svg', 'type' => 'after', 'caption' => 'Luxury metallic texture living hall after completion', 'sort_order' => 2]);

        $project3 = Project::create([
            'customer_id' => $customerABC->id,
            'service_id' => $serviceInd->id,
            'title' => 'Commercial Facility & Heavy Duty Epoxy Flooring',
            'slug' => 'commercial-facility-epoxy-ambattur',
            'property_type' => 'Commercial',
            'painting_type' => 'Both',
            'location' => 'Ambattur Industrial Estate',
            'area_sqft' => '45,000 sq.ft',
            'year_completed' => '2025',
            'work_details' => 'Self-leveling 2mm industrial epoxy floor coating, structural steel anti-corrosive primer, warehouse exterior painting',
            'description' => 'Industrial warehouse renovation in Ambattur. We executed 45,000 sq.ft of high-impact self-leveling epoxy flooring, safety walkway demarcation lines, and high-altitude steel truss anti-rust spray painting.',
            'start_date' => '2025-11-01',
            'expected_end_date' => '2025-12-15',
            'completed_date' => '2025-12-12',
            'status' => 'Completed',
            'progress_percent' => 100,
            'total_amount' => 1250000.00,
            'paid_amount' => 1250000.00,
            'cover_image' => 'images/project3_after.svg',
            'is_featured' => true,
            'show_before_after' => true,
            'team_supervisor' => 'G. Chandran',
            'materials_used' => 'Berger Epilux Epoxy Floor System, Zinc Chromate Steel Primer, Safety Yellow PU Marking',
            'admin_notes' => 'Commercial floor inspection passed with zero defects.',
        ]);

        ProjectImage::create(['project_id' => $project3->id, 'image_path' => 'images/project3_before.svg', 'type' => 'before', 'caption' => 'Damaged industrial concrete floor before epoxy treatment', 'sort_order' => 1]);
        ProjectImage::create(['project_id' => $project3->id, 'image_path' => 'images/project3_after.svg', 'type' => 'after', 'caption' => 'High-gloss seamless epoxy floor with safety markings', 'sort_order' => 2]);

        $project4 = Project::create([
            'customer_id' => $customerPriya->id,
            'service_id' => $serviceRes->id,
            'title' => 'Velachery Residence Modern Interior Revamp',
            'slug' => 'velachery-residence-interior-revamp',
            'property_type' => 'House',
            'painting_type' => 'Interior',
            'location' => 'Velachery, Chennai',
            'area_sqft' => '3,200 sq.ft',
            'year_completed' => '2026',
            'work_details' => 'Complete interior wall smoothing, acrylic putty 2-coats, low-odour washable emulsion & kids room stencil art',
            'description' => 'Modern interior painting for a 3-bedroom villa in Velachery. Features anti-bacterial health shield paints in bedrooms and custom pastel color scheme.',
            'start_date' => '2026-08-20',
            'expected_end_date' => '2026-09-10',
            'status' => 'In Progress',
            'progress_percent' => 40,
            'total_amount' => 110000.00,
            'paid_amount' => 45000.00,
            'cover_image' => 'images/project4_after.svg',
            'is_featured' => true,
            'show_before_after' => true,
            'team_supervisor' => 'S. Rajan',
            'materials_used' => 'Dulux Velvet Touch, Acrylic Putty, Anti-Bacterial Primer',
            'admin_notes' => 'Putty sanding completed in 2 bedrooms. Base coat starting tomorrow.',
        ]);

        ProjectImage::create(['project_id' => $project4->id, 'image_path' => 'images/project4_before.svg', 'type' => 'before', 'caption' => 'Original wall before sanding & putty prep', 'sort_order' => 1]);
        ProjectImage::create(['project_id' => $project4->id, 'image_path' => 'images/project4_after.svg', 'type' => 'after', 'caption' => 'Pastel velvet sheen interior finish sample', 'sort_order' => 2]);

        // 6. Seed Enquiries
        Enquiry::create([
            'name' => 'K. Soundararajan',
            'phone' => '9841098765',
            'email' => 'soundar@gmail.com',
            'property_type' => 'Apartment',
            'location' => 'Avadi, Chennai',
            'painting_type' => 'Exterior',
            'approx_area' => '15,000 sq.ft',
            'floors' => '3 Floors',
            'preferred_start_date' => '2026-09-10',
            'additional_requirements' => 'Waterproof crack sealing on south wall due to heavy rain seepage. Need formal estimate for society meeting.',
            'status' => 'New',
        ]);

        Enquiry::create([
            'name' => 'TechSpace Corp (Admin Saravanan)',
            'phone' => '9884011223',
            'email' => 'admin@techspace.in',
            'property_type' => 'Commercial',
            'location' => 'Ambattur, Chennai',
            'painting_type' => 'Interior',
            'approx_area' => '8,500 sq.ft',
            'floors' => '2 Floors',
            'preferred_start_date' => '2026-09-05',
            'additional_requirements' => 'Office space interior painting over a weekend. Zero odour paint required.',
            'status' => 'Contacted',
            'admin_notes' => 'Spoke to Saravanan on Aug 30. Site visit scheduled for Sept 1.',
        ]);

        Enquiry::create([
            'name' => 'Mrs. Meenakshi Sundaram',
            'phone' => '9789054321',
            'email' => 'meenakshi@yahoo.com',
            'property_type' => 'House',
            'location' => 'Porur, Chennai',
            'painting_type' => 'Both',
            'approx_area' => '2,200 sq.ft',
            'floors' => 'G+1 House',
            'preferred_start_date' => '2026-09-15',
            'additional_requirements' => 'Repainting before daughter wedding in October. Wants golden metallic wall in hall.',
            'status' => 'Site Visit',
            'admin_notes' => 'Visited site on Aug 28. Measurements taken. Quote sent.',
        ]);

        // 7. Seed Quotations & Items
        $quote1 = Quotation::create([
            'quotation_number' => 'EST-2026-001',
            'project_id' => $project1->id,
            'customer_id' => $customerRamesh->id,
            'customer_name' => 'Ramesh Kumar (Royal Apartments)',
            'customer_phone' => '9840123456',
            'customer_email' => 'ramesh@example.com',
            'property_location' => 'Anna Nagar, Chennai',
            'quote_date' => '2026-07-25',
            'valid_until' => '2026-08-25',
            'subtotal' => 450000.00,
            'tax_amount' => 35000.00,
            'total_amount' => 485000.00,
            'status' => 'Approved',
            'terms_and_conditions' => '1. 40% Advance on project start, 40% after primary coat, 20% on final handover.\n2. 5-Year warranty against paint peeling and algae.\n3. All scaffolding and safety mesh setup included.',
            'notes' => 'Approved by society president Ramesh Kumar on July 28.',
        ]);

        QuotationItem::create([
            'quotation_id' => $quote1->id,
            'item_description' => 'Pressure Jet Surface Cleaning & Algae Scrape-off (25,000 sq.ft)',
            'quantity_unit' => 'sq.ft',
            'quantity' => 25000,
            'unit_rate' => 2.00,
            'total_price' => 50000.00,
        ]);

        QuotationItem::create([
            'quotation_id' => $quote1->id,
            'item_description' => 'Crack Bridging Sealer & Asian Paints Damp Proof Primer Coat',
            'quantity_unit' => 'sq.ft',
            'quantity' => 25000,
            'unit_rate' => 6.00,
            'total_price' => 150000.00,
        ]);

        QuotationItem::create([
            'quotation_id' => $quote1->id,
            'item_description' => 'Asian Paints Apex Ultima Protek Elastomeric Exterior 2-Coat System',
            'quantity_unit' => 'sq.ft',
            'quantity' => 25000,
            'unit_rate' => 10.00,
            'total_price' => 250000.00,
        ]);

        // 8. Seed Testimonials
        Testimonial::create([
            'client_name' => 'S. Ranganathan (Association Secretary)',
            'location' => 'Anna Nagar, Chennai',
            'project_title' => 'Apartment Exterior Weather Proofing',
            'rating' => 5,
            'review_text' => 'Mr. Chandran and his painting crew transformed our 20-year-old apartment building. They were incredibly disciplined, protected all parked vehicles, and delivered a factory-clean finish. Highly recommended!',
            'avatar' => 'images/avatar1.svg',
            'is_featured' => true,
        ]);

        Testimonial::create([
            'client_name' => 'Dr. K. Swaminathan',
            'location' => 'Avadi, Chennai',
            'project_title' => 'Duplex Villa Interior & Texture Wall',
            'rating' => 5,
            'review_text' => 'The Royale Play metallic wall texture in our hall receives compliments from every visitor. Dust-free sanding made a huge difference as we were residing in the house during work.',
            'avatar' => 'images/avatar2.svg',
            'is_featured' => true,
        ]);

        Testimonial::create([
            'client_name' => 'V. Rajesh (Plant Manager)',
            'location' => 'Ambattur Industrial Estate',
            'project_title' => 'Industrial Epoxy Floor Coating',
            'rating' => 5,
            'review_text' => 'Exceptional quality epoxy floor work. Finished 45,000 sq.ft within strict industrial shutdown days. Smooth coordination and transparent pricing.',
            'avatar' => 'images/avatar3.svg',
            'is_featured' => true,
        ]);

        // 9. Seed Gallery Items
        $categories = ['Exterior', 'Interior', 'Apartment', 'Residential', 'Commercial', 'Industrial'];
        foreach ($categories as $idx => $cat) {
            Gallery::create([
                'title' => "$cat Painting Excellence Showcase",
                'category' => $cat,
                'image_path' => "images/gallery_" . strtolower($cat) . ".svg",
                'description' => "Professional $cat execution by GC Painting with premium weather seal finish.",
                'sort_order' => $idx + 1,
            ]);
        }

        // 10. Seed Website Settings
        $settings = [
            'business_name' => 'GC Painting & Decorators',
            'owner_name' => 'G. Chandran & Family',
            'phone' => '+91 99410 43220',
            'whatsapp' => '918925014875',
            'email' => 'contact@gcpainting.com',
            'experience_years' => '22+',
            'address' => 'No. 45, Main Road, Anna Nagar / Avadi, Chennai, Tamil Nadu - 600054',
            'working_locations' => 'Chennai, Avadi, Ambattur, Velachery, Porur, Tambaram, Anna Nagar, Guindy, Maduravoyal',
            'completed_projects_count' => '350+',
            'active_projects_count' => '4',
            'happy_clients_count' => '500+',
            'hero_title' => 'Transforming Homes, Apartments & Buildings With Quality & Care',
            'hero_subtitle' => 'Over 22+ Years of Trusted Professional Painting Experience Across Chennai & Tamil Nadu',
        ];

        foreach ($settings as $key => $val) {
            WebsiteSetting::setKey($key, $val);
        }
    }

    private function generateSvgImages(string $dir): void
    {
        $svgs = [
            'service_residential.svg' => $this->createServiceSvg('#2563eb', '#1d4ed8', 'RESIDENTIAL PAINTING', 'Villas & Houses'),
            'service_apartment.svg' => $this->createServiceSvg('#0284c7', '#0369a1', 'APARTMENT PAINTING', 'Complexes & Towers'),
            'service_commercial.svg' => $this->createServiceSvg('#4f46e5', '#4338ca', 'COMMERCIAL PAINTING', 'Offices & Retail'),
            'service_industrial.svg' => $this->createServiceSvg('#d97706', '#b45309', 'INDUSTRIAL PAINTING', 'Epoxy & Warehouses'),
            'service_interior.svg' => $this->createServiceSvg('#059669', '#047857', 'INTERIOR PAINTING', 'Royal Finishes & Putty'),
            'service_exterior.svg' => $this->createServiceSvg('#dc2626', '#b91c1c', 'EXTERIOR PAINTING', 'Weather Proof Shield'),

            'project1_before.svg' => $this->createBeforeAfterSvg('#78716c', '#44403c', 'BEFORE', 'Apartment Elevation (Faded & Water Damaged)', '#ef4444'),
            'project1_during.svg' => $this->createBeforeAfterSvg('#0284c7', '#0369a1', 'IN PROGRESS (75%)', 'Scaffolding & Waterproof Primer Applied', '#f59e0b'),
            'project1_after.svg' => $this->createBeforeAfterSvg('#10b981', '#059669', 'AFTER', 'Vibrant Azure Weather Shield Coating', '#10b981'),

            'project2_before.svg' => $this->createBeforeAfterSvg('#94a3b8', '#64748b', 'BEFORE', 'Dull Stained Living Room Walls', '#ef4444'),
            'project2_after.svg' => $this->createBeforeAfterSvg('#f59e0b', '#d97706', 'AFTER', 'Royale Play Gold Metallic Texture', '#10b981'),

            'project3_before.svg' => $this->createBeforeAfterSvg('#71717a', '#52525b', 'BEFORE', 'Rough Cracker Concrete Warehouse Floor', '#ef4444'),
            'project3_after.svg' => $this->createBeforeAfterSvg('#2563eb', '#1d4ed8', 'AFTER', 'High Gloss Epoxy Floor & Safety Lines', '#10b981'),

            'project4_before.svg' => $this->createBeforeAfterSvg('#a1a1aa', '#71717a', 'BEFORE', 'Old Damaged Villa Walls', '#ef4444'),
            'project4_after.svg' => $this->createBeforeAfterSvg('#8b5cf6', '#7c3aed', 'AFTER', 'Smooth Pastel Velvet Interior', '#10b981'),

            'gallery_exterior.svg' => $this->createServiceSvg('#0284c7', '#0369a1', 'EXTERIOR GALLERY', 'Weather Guard Shield'),
            'gallery_interior.svg' => $this->createServiceSvg('#059669', '#047857', 'INTERIOR GALLERY', 'Luxury Velvet Sheen'),
            'gallery_apartment.svg' => $this->createServiceSvg('#2563eb', '#1d4ed8', 'APARTMENT GALLERY', 'High-Rise Scaffolding'),
            'gallery_residential.svg' => $this->createServiceSvg('#4f46e5', '#4338ca', 'RESIDENTIAL GALLERY', 'Custom Duplex House'),
            'gallery_commercial.svg' => $this->createServiceSvg('#d97706', '#b45309', 'COMMERCIAL GALLERY', 'Corporate IT Office'),
            'gallery_industrial.svg' => $this->createServiceSvg('#dc2626', '#b91c1c', 'INDUSTRIAL GALLERY', 'Epoxy Floor Finish'),

            'avatar1.svg' => $this->createAvatarSvg('SR', '#2563eb'),
            'avatar2.svg' => $this->createAvatarSvg('KS', '#10b981'),
            'avatar3.svg' => $this->createAvatarSvg('VR', '#f59e0b'),
        ];

        foreach ($svgs as $filename => $content) {
            File::put($dir . '/' . $filename, $content);
        }
    }

    private function createServiceSvg($color1, $color2, $title, $subtitle): string
    {
        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 500" width="800" height="500">
  <defs>
    <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="{$color1}" />
      <stop offset="100%" stop-color="{$color2}" />
    </linearGradient>
  </defs>
  <rect width="100%" height="100%" fill="url(#grad)" />
  <circle cx="700" cy="100" r="180" fill="white" opacity="0.08" />
  <circle cx="100" cy="400" r="220" fill="white" opacity="0.05" />
  
  <!-- Architectural House / Roller Graphic -->
  <path d="M 400 120 L 580 260 L 530 260 L 530 360 L 270 360 L 270 260 L 220 260 Z" fill="white" opacity="0.15" />
  <path d="M 400 140 L 550 260 L 510 260 L 510 340 L 290 340 L 290 260 L 250 260 Z" fill="none" stroke="white" stroke-width="4" stroke-linecap="round" opacity="0.7" />
  <circle cx="400" cy="240" r="35" fill="white" opacity="0.9" />
  <path d="M 390 240 L 410 240 M 400 230 L 400 250" stroke="{$color1}" stroke-width="5" stroke-linecap="round" />
  
  <text x="400" y="410" font-family="'Inter', sans-serif" font-size="32" font-weight="800" fill="#ffffff" text-anchor="middle" letter-spacing="2">{$title}</text>
  <text x="400" y="445" font-family="'Inter', sans-serif" font-size="18" font-weight="500" fill="#e0f2fe" text-anchor="middle">{$subtitle}</text>
</svg>
SVG;
    }

    private function createBeforeAfterSvg($color1, $color2, $badgeText, $subtitle, $badgeBg): string
    {
        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 500" width="800" height="500">
  <defs>
    <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="{$color1}" />
      <stop offset="100%" stop-color="{$color2}" />
    </linearGradient>
  </defs>
  <rect width="100%" height="100%" fill="url(#grad)" />
  <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1" opacity="0.1" />
  </pattern>
  <rect width="100%" height="100%" fill="url(#grid)" />
  
  <rect x="40" y="40" width="180" height="48" rx="24" fill="{$badgeBg}" />
  <text x="130" y="71" font-family="'Inter', sans-serif" font-size="18" font-weight="900" fill="#ffffff" text-anchor="middle" letter-spacing="1">{$badgeText}</text>
  
  <text x="400" y="270" font-family="'Inter', sans-serif" font-size="24" font-weight="700" fill="#ffffff" text-anchor="middle">{$subtitle}</text>
  <text x="400" y="310" font-family="'Inter', sans-serif" font-size="16" fill="#f1f5f9" text-anchor="middle">GC Painting &amp; Decorators — Professional Finish</text>
</svg>
SVG;
    }

    private function createAvatarSvg($initials, $bg): string
    {
        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" width="120" height="120">
  <circle cx="60" cy="60" r="60" fill="{$bg}" />
  <text x="60" y="72" font-family="'Inter', sans-serif" font-size="42" font-weight="800" fill="#ffffff" text-anchor="middle">{$initials}</text>
</svg>
SVG;
    }
}
