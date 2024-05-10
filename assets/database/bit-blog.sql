-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2024 at 02:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bit-blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(9, 'Cyber Threats', '2024-05-10 13:49:14', NULL),
(10, 'Cybersecurity Basics', '2024-05-10 14:00:25', NULL),
(11, 'Network Security', '2024-05-10 14:00:53', NULL),
(12, 'Cybersecurity in the Cloud', '2024-05-10 14:27:29', '2024-05-10 14:28:15');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) NOT NULL,
  `title` varchar(191) NOT NULL,
  `body` text NOT NULL,
  `cat_id` int(10) NOT NULL,
  `status` tinyint(5) NOT NULL DEFAULT 10,
  `image` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `cat_id`, `status`, `image`, `created_at`, `updated_at`, `user_id`) VALUES
(13, 'Firewalls: How They Protect Your Network', '<h3>Understanding Firewalls</h3>\r\n\r\n<p>At its core, a firewall is a security system designed to monitor and control incoming and outgoing network traffic based on predetermined security rules. These rules dictate which traffic is allowed to pass through and which is blocked, effectively creating a filter that screens data packets to ensure they meet specified criteria.</p>\r\n\r\n<h3>Types of Firewalls</h3>\r\n\r\n<p>There are several types of firewalls, each with its own approach to filtering network traffic:</p>\r\n\r\n<ol>\r\n	<li>\r\n	<p><strong>Packet Filtering Firewalls:</strong> These firewalls examine individual data packets as they travel between networks, allowing or denying traffic based on predefined rules.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Stateful Inspection Firewalls:</strong> Going beyond packet filtering, stateful inspection firewalls maintain a record of the state of active connections, allowing them to make more intelligent decisions about which packets to allow or block.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Proxy Firewalls:</strong> Proxy firewalls act as intermediaries between internal and external networks, intercepting and forwarding traffic on behalf of clients. They can provide additional security by hiding the internal network&#39;s IP addresses from external sources.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Next-Generation Firewalls (NGFW):</strong> NGFWs combine traditional firewall functionality with advanced features such as intrusion prevention, application awareness, and deep packet inspection, offering comprehensive protection against modern threats.</p>\r\n	</li>\r\n</ol>\r\n\r\n<h3>How Firewalls Protect Your Network</h3>\r\n\r\n<p>Firewalls play a crucial role in safeguarding your network by:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Preventing Unauthorized Access:</strong> By filtering incoming and outgoing traffic, firewalls block unauthorized attempts to access your network, reducing the risk of intrusions and data breaches.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Controlling Network Traffic:</strong> Firewalls enforce security policies to regulate the flow of traffic, ensuring that only legitimate connections are established while blocking malicious or suspicious activity.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Detecting and Blocking Threats:</strong> Advanced firewalls use techniques like intrusion detection and prevention to identify and thwart known threats, including malware, viruses, and hacking attempts.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Securing Remote Access:</strong> Firewalls can secure remote access to your network through Virtual Private Networks (VPNs), encrypting data transmissions and authenticating remote users to prevent unauthorized access.</p>\r\n	</li>\r\n</ul>\r\n', 11, 10, '/assets/images/posts/2024_05_10_13_04_34.jpeg', '2024-05-10 14:04:34', NULL, 1),
(14, 'Introduction to Cybersecurity: Understanding the Threat Landscape', '<p>Introduction to Cybersecurity: Understanding the Threat Landscape</p>\r\n\r\n<p>Cybersecurity is a critical aspect of modern-day digital life, encompassing practices, technologies, and strategies designed to protect digital assets, systems, and networks from malicious actors. Understanding the threat landscape is the first step towards building effective cybersecurity defenses.</p>\r\n\r\n<p><strong>Key Points:</strong></p>\r\n\r\n<ol>\r\n	<li>\r\n	<p><strong>Cyber Threat Landscape:</strong></p>\r\n\r\n	<ul>\r\n		<li>The threat landscape is constantly evolving, with cyber threats ranging from relatively simple phishing attacks to sophisticated nation-state-sponsored cyber espionage campaigns. Understanding the types of threats organizations face is essential for implementing appropriate security measures.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Common Threat Actors:</strong></p>\r\n\r\n	<ul>\r\n		<li>Threat actors can include individual hackers, organized cybercriminal groups, state-sponsored attackers, and even insider threats. Each category of threat actor may have different motivations, targets, and levels of sophistication.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Attack Vectors:</strong></p>\r\n\r\n	<ul>\r\n		<li>Attackers exploit various vulnerabilities and attack vectors to compromise systems and networks. These can include software vulnerabilities, misconfigured systems, social engineering tactics, and more. Understanding these attack vectors is crucial for mitigating risk effectively.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Impact of Cyber Attacks:</strong></p>\r\n\r\n	<ul>\r\n		<li>Cyber attacks can have significant financial, reputational, and operational consequences for organizations. These may include financial losses due to data breaches, damage to brand reputation, regulatory fines for non-compliance, and disruption to business operations.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Cybersecurity Defense Strategies:</strong></p>\r\n\r\n	<ul>\r\n		<li>Effective cybersecurity defense strategies involve a combination of preventive, detective, and responsive measures. These may include implementing robust access controls, regularly patching and updating systems, conducting security awareness training for employees, and establishing incident response plans.</li>\r\n	</ul>\r\n	</li>\r\n</ol>\r\n', 10, 10, '/assets/images/posts/2024_05_10_13_07_56.jpeg', '2024-05-10 14:07:56', NULL, 7),
(15, 'Types of Malware: Viruses, Worms, Trojans, and Ransomware', '<p>Malware, short for malicious software, is a broad term that encompasses various types of software designed to infiltrate, damage, or gain unauthorized access to computer systems or data. Here, we&#39;ll delve into some common types of malware:</p>\r\n\r\n<ol>\r\n	<li>\r\n	<p><strong>Viruses:</strong></p>\r\n\r\n	<ul>\r\n		<li>Viruses are among the oldest and most well-known types of malware. They attach themselves to legitimate programs and execute when these programs are run. Viruses can replicate themselves and spread to other files or systems, often causing damage by corrupting or deleting files, or even rendering the system inoperable.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Worms:</strong></p>\r\n\r\n	<ul>\r\n		<li>Unlike viruses, worms don&#39;t need to attach themselves to other programs to propagate. They spread independently by exploiting vulnerabilities in network protocols or through email attachments. Worms can rapidly infect large numbers of devices connected to a network, causing congestion, data loss, or even system crashes.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Trojans:</strong></p>\r\n\r\n	<ul>\r\n		<li>Named after the infamous Trojan horse from Greek mythology, Trojans masquerade as legitimate software to deceive users into downloading and executing them. Once activated, Trojans can perform a variety of malicious actions, such as stealing sensitive information, creating backdoors for remote access, or launching attacks on other systems.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Ransomware:</strong></p>\r\n\r\n	<ul>\r\n		<li>Ransomware is a particularly insidious form of malware that encrypts the victim&#39;s files or locks them out of their system, demanding a ransom in exchange for restoring access. Ransomware attacks have become increasingly prevalent and sophisticated, targeting individuals, businesses, and even critical infrastructure, causing significant financial losses and disruption.</li>\r\n	</ul>\r\n	</li>\r\n</ol>\r\n', 9, 10, '/assets/images/posts/2024_05_10_13_09_26.jpg', '2024-05-10 14:09:26', NULL, 7),
(16, 'Exploring the World of DDoS Attacks: How They Work and How to Mitigate Them', '<p>Distributed Denial of Service (DDoS) attacks are a type of cyberattack aimed at disrupting the normal functioning of a targeted system or network by overwhelming it with a flood of traffic. Here&#39;s a closer look at how DDoS attacks operate and strategies for mitigating their impact:</p>\r\n\r\n<ol>\r\n	<li>\r\n	<p><strong>How DDoS Attacks Work:</strong></p>\r\n\r\n	<ul>\r\n		<li>In a DDoS attack, the attacker leverages a network of compromised devices, known as botnets, to flood the target with an overwhelming volume of traffic. This flood of traffic can consume the target&#39;s network bandwidth, exhaust server resources, or disrupt access to legitimate users, effectively rendering the target inaccessible.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Types of DDoS Attacks:</strong></p>\r\n\r\n	<ul>\r\n		<li>DDoS attacks come in various forms, including volumetric attacks that aim to overwhelm network bandwidth, protocol attacks that exploit weaknesses in network protocols, and application-layer attacks that target specific applications or services running on the server.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Mitigation Techniques:</strong></p>\r\n\r\n	<ul>\r\n		<li>Effective mitigation of DDoS attacks requires a multi-layered approach. This includes implementing network-level defenses such as firewalls and intrusion prevention systems (IPS) to filter out malicious traffic, deploying DDoS mitigation services that can detect and block attack traffic in real-time, and optimizing network infrastructure to handle sudden spikes in traffic.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Content Delivery Networks (CDNs):</strong></p>\r\n\r\n	<ul>\r\n		<li>CDNs can help mitigate the impact of DDoS attacks by distributing content across multiple servers located in different geographical regions. By caching and serving content closer to end-users, CDNs can absorb and mitigate the effects of DDoS attacks by spreading the load across their infrastructure.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Traffic Scrubbing Services:</strong></p>\r\n\r\n	<ul>\r\n		<li>Some organizations rely on specialized DDoS mitigation providers that offer traffic scrubbing services. These providers analyze incoming traffic, identify malicious patterns, and filter out DDoS traffic while allowing legitimate traffic to pass through, thus minimizing disruption to the target&#39;s services.</li>\r\n	</ul>\r\n	</li>\r\n</ol>\r\n', 9, 10, '/assets/images/posts/2024_05_10_13_23_35.png', '2024-05-10 14:20:25', '2024-05-10 14:23:35', 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `first_name` varchar(191) NOT NULL,
  `last_name` varchar(191) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `created_at`) VALUES
(1, 'admin@gmail.com', '$2y$10$WVKztRqoua2IIy8bMhr5w.e0bI6wCCERriqgtOrlR7seYpBAwMr/S', 'Admin', 'BitBlog', '2024-08-05 15:26:20'),
(6, 'xdalyas4@gmail.com', '$2y$10$WlldGVjHT9kqPMK90V72fOCLEi1.ySGkdV.vy.Zag98JbHzVPif0u', 'Dalya', 'Malathi', '2024-05-10 13:03:37'),
(7, 'nora@hotmail.com', '$2y$10$WlldGVjHT9kqPMK90V72fOCLEi1.ySGkdV.vy.Zag98JbHzVPif0u', 'nora', 'harbi', '2024-05-10 14:06:22'),
(8, 'm@live.com', '$2y$10$3rxATkRB.NbR/Xvcl30GFeAi1S.QH.33u23CPKrZ1N4vDkrAtVYQO', 'madawi', 'M', '2024-05-10 14:31:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
