-- BB88 CMS Database Schema & Seed Data

CREATE DATABASE IF NOT EXISTS `cms_bb88_landing` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `cms_bb88_landing`;

-- 1. Admins Table
CREATE TABLE IF NOT EXISTS `admins` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(255) NOT NULL UNIQUE,
    `password_hash` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Page Sections Table
CREATE TABLE IF NOT EXISTS `page_sections` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `section` VARCHAR(100) NOT NULL UNIQUE,
    `content` LONGTEXT NOT NULL,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Default Admin Account (Username: admin, Password: password123)
INSERT INTO `admins` (`username`, `password_hash`)
VALUES ('admin', '$2y$10$0u5nWgeOgSAalror/ugbx.5ah5xBzy8HYYwmidnnu4Q/MKTptI9Om')
ON DUPLICATE KEY UPDATE `username` = VALUES(`username`);

-- 4. Seed Page Sections
INSERT INTO `page_sections` (`section`, `content`) VALUES
('about', '{
  "services": {
    "title": "Design and Marketing Solutions",
    "icons": [
      { "image": "assets/icon/icon design ideas.png", "label": "Design Ideas" },
      { "image": "assets/icon/icon Digital & Mainstream.png", "label": "Digital & Mainstream Marketing" },
      { "image": "assets/icon/icon Brand & Identity.png", "label": "Brand & Identity" },
      { "image": "assets/icon/icon Digital Solutions.png", "label": "Digital Solutions" }
    ]
  },
  "about": {
    "title": "About Us",
    "subtitle": "Creative Solutions for Impactful Brand Communication",
    "paragraphs": [
      "BB 88 Advertising & Digital Solutions Inc. is a \\\"One-Stop\\\" shop for design and communication strategy, specializing in graphic design, architectural design, realistic visual production, web app and mobile application. Our focus is on creating the best design to effectively sell your products and services through high impact visual mediums. We can help turn your ideas and creative perspective into a successful communication strategy.",
      "Our philosophy is based on our passion to deliver the RIGHT message at the RIGHT time with the RIGHT solution. With a combined team of dedicated professionals from varied creative industries & powered by \\\"State of the Art\\\" equipment, we do our work best with the clients to integrate branding and marketing strategy. BB 88 support team innovates unique identity of products and services that would enable our customers to establish presence in their target market.",
      "At BB 88 Advertising & Digital Solutions Inc., we believe that our ability to focus on our customers needs and target audience sets us apart in the industry. Our distinctive design concepts and production approach, combined with expert technical support, allow us to cover all aspects of mass communication, including print video radio, and the internet. Our group of companies are ready to provide you with the support you need to succeed in today\'s rapidly-evolving landscape."
    ]
  }
}'),

('contact', '{
  "vectors": {
    "topLeft": "./assets/bg/vector5.png",
    "bottomRight": "./assets/bg/vector 5.0.png"
  },
  "header": {
    "title": "Contact",
    "subtitle": "For immediate assistance, contact us 9:00 AM - 6:00 PM<br />to address any emergency needs."
  },
  "mapUrl": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3851.4443901614945!2d120.588888!3d15.133333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3396f24df45214ab%3A0x6bd6c7e2b1090be4!2sPlaza%20Victoria%2C%20Angeles%2C%20Pampanga!5e0!3m2!1sen!2sph!4v1700000000000!5m2!1sen!2sph",
  "infoPills": [
    { "iconClass": "fa-solid fa-phone", "label": "Phone:", "value": "+63 45 963 2025", "isDesc": false },
    { "iconClass": "fa-solid fa-envelope", "label": "Email:", "value": "info@bb88advertising.com", "isDesc": false },
    { "iconClass": "fa-solid fa-clock", "label": "Open Hours:", "value": "Mon-Sat: 9:00 AM - 6:00 PM", "isDesc": false },
    { "iconClass": "fa-solid fa-location-dot", "label": "Location:", "value": "Unit D, 2nd Floor Plaza Victoria Bldg., Sto. Rosario St.,<br />Sto. Domingo, Angeles City 2009 Philippines", "isDesc": true }
  ],
  "footer": {
    "companyName": "BB 88 ADVERTISING",
    "subTitle": "AND DIGITAL SOLUTIONS INC."
  }
}'),

('footer', '{
  "socialTitle": "Follow us on",
  "socialLinks": [
    { "platform": "Facebook", "url": "#", "iconClass": "fa-brands fa-facebook-f text-xs" },
    { "platform": "Instagram", "url": "#", "iconClass": "fa-brands fa-instagram text-xs" },
    { "platform": "X (Twitter)", "url": "#", "iconClass": "fa-brands fa-x text-xs" },
    { "platform": "LinkedIn", "url": "#", "iconClass": "fa-brands fa-linkedin-in text-xs" }
  ],
  "copyrightText": "©2026 BB 88 Advertising & Digital Solutions Inc., All Rights Reserved. &nbsp;|&nbsp; Designed & Developed by BB 88 Advertising and Digital Solutions Inc."
}'),

('header', '[
  {
    "id": 1,
    "title": "BB88 Landing Page",
    "colors": [
      "bg-[#48887b]",
      "bg-[#a8cf45]",
      "bg-[#1f3d37]",
      "bg-[#3d7368]",
      "bg-white",
      "bg-[#3a7266]"
    ]
  }
]'),

('navbar', '{
  "logo": {
    "src": "assets/logo/logo bb88.png",
    "alt": "BB88 Logo",
    "id": "main-logo"
  },
  "cta": {
    "text": "Get Started",
    "url": "/get-started",
    "id": "cta-button"
  },
  "links": [
    { "text": "Home", "url": "#hero" },
    { "text": "About", "url": "#about" },
    { "text": "Services", "url": "#services" },
    { "text": "Portfolio", "url": "#portfolio" },
    { "text": "Team", "url": "#team" },
    { "text": "Contact", "url": "#contact" }
  ]
}'),

('portfolio', '[
  { "image": "./assets/picture/pic1.png", "title": "BC Bagsakan Pickup", "description": "Your dependable partner in farm-to-market local logistics", "category": "Mobile App" },
  { "image": "./assets/picture/pic2.png", "title": "Bio-MOBAPP", "description": "Access agricultural biodata and systems right from your pocket", "category": "Mobile App" },
  { "image": "./assets/picture/pic3.png", "title": "BC Bagsakan Delivery", "description": "Direct tracking and seamless distribution logistics systems", "category": "Mobile App" },
  { "image": "./assets/picture/pic4.png", "title": "Biorganism", "description": "Katulong mo sa pagsasaka", "category": "Mobile App" },
  { "image": "./assets/picture/pic5.png", "title": "EM & A Architectural", "description": "Corporate identity and professional branding materials", "category": "Brand & Design" },
  { "image": "./assets/picture/pic6.png", "title": "Greenhouse Paradise", "description": "Branding concept and structural marketing documentation", "category": "Brand & Design" },
  { "image": "./assets/picture/pic7.png", "title": "MHR", "description": "Professional business stationery design and visual concepts", "category": "Brand & Design" },
  { "image": "./assets/picture/pic8.png", "title": "Migs", "description": "Complete localized system identity and design services", "category": "Brand & Design" },
  { "image": "./assets/picture/pic9.png", "title": "Filipino Land", "description": "Official identity and digital solution styling properties", "category": "Brand & Design" }
]'),

('recent-posts', '[
  { "image": "./assets/picture/picture1.png", "category": "Politics", "title": "E-Commerce\'s Impact on Marketing:", "description": "Harnessing Online Channels to Boost Sales and Reach New Customers", "link": "#" },
  { "image": "./assets/picture/picture2.png", "category": "Sports", "title": "The Rise of Mobile Marketing:", "description": "Creating Mobile-Optimized Campaigns to Reach Customers on-the-go", "link": "#" },
  { "image": "./assets/picture/picture3.png", "category": "Entertainment", "title": "The Rise of Mobile Marketing:", "description": "Creating Mobile-Optimized Campaigns to Reach Customers on-the-go", "link": "#" }
]'),

('team', '{
  "title": "Our Team",
  "defaultRole": "multimedia",
  "roles": [
    { "id": "software", "name": "Software Engineers", "icon": "./assets/icon/ourteam(icon1).png", "row": 1, "description": "Our Software Engineers are responsible for building robust backend infrastructures, managing reliable databases, and integrating systems to ensure seamless and high-performing web and mobile platform integrations." },
    { "id": "web", "name": "Web Developers", "icon": "./assets/icon/ourteam(icon2).png", "row": 1, "description": "Web Developers focus on implementing responsive, cutting-edge user interfaces using frameworks like Angular and Tailwind CSS. They bring design wireframes to life with dynamic client-side interactions." },
    { "id": "app", "name": "App Developers", "icon": "./assets/icon/ourteam(icon3).png", "row": 1, "description": "App Developers specialize in creating powerful mobile applications (such as Flutter solutions) that ensure a consistent, secure, and intuitive user experience across both iOS and Android environments." },
    { "id": "graphic", "name": "Graphic Artists", "icon": "./assets/icon/ourteam(icon4).png", "row": 1, "description": "Graphic Artists craft unique visual identities, logo kits, and brand assets. They make sure the color palettes, shapes, and marketing graphics are highly visually appealing and convey the exact message of your business." },
    { "id": "multimedia", "name": "Multimedia Artists", "icon": "./assets/icon/ourteam(icon7).png", "row": 2, "description": "Multimedia Artists are similar to Graphic Artists, but they specialize in creating dynamic and interactive content like videos, 3D animations, and virtual reality experiences. They use a variety of software tools to create engaging and immersive experiences for users." },
    { "id": "writers", "name": "Creative Writers", "icon": "./assets/icon/ourteam(icon5).png", "row": 2, "description": "Our Creative Writers design engaging copies, optimize SEO descriptions, draft professional project plans, and establish high-quality communication strategies tailored directly to your target audiences." },
    { "id": "director", "name": "Creative Director", "icon": "./assets/icon/ourteam(icon6).png", "row": 2, "description": "The Creative Director steers the overall design direction and vision of the projects, aligning team output with client goals to build a powerful and highly-marketable branding narrative." }
  ]
}')
ON DUPLICATE KEY UPDATE `content` = VALUES(`content`);
