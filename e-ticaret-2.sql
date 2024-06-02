-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 02 Haz 2024, 13:06:46
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `e-ticaret`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_surname` varchar(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL,
  `admin_status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_name`, `admin_surname`, `admin_username`, `admin_pass`, `admin_status`) VALUES
(13, 'eren', 'kızılırmak', 'ekız', '2002', 1),
(18, 'berk', 'kanburlar', 'bkan', '121212', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `category_id` int(32) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_img` text NOT NULL,
  `category_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_img`, `category_description`) VALUES
(1, 'Technology', '/images/categories/technology.jpg', 'Equip yourself for anything. Explore our vast selection of electronics, computers, and accessories. Whether you\'re a seasoned professional, a creative mind, or a casual user, we have the tech to elevate your experience.'),
(2, 'Other', '/images/categories/other.jpeg', 'From mountain peaks to city streets, equip yourself for any adventure. Browse our extensive collection of performance apparel, footwear, and camping gear. Whether you\'re chasing a personal best or escaping the everyday, we have the tools to help you conquer your goals in comfort and style.'),
(4, 'Books', '/images/categories/books.jpg', 'From award-winning novels to gripping true-life accounts, explore a world of possibilities with our diverse collection of books. We offer titles for all ages and interests, so you can find the perfect book to spark your curiosity and ignite your passion.'),
(5, 'Beauty & Skin Care', '/images/categories/beauty.jpg', 'Elevate your natural beauty and discover a world of self-care. Explore our comprehensive collection of skincare, makeup, and fragrance for all skin types and concerns'),
(6, 'Fashion', '/images/categories/fashion.jpg', 'More than just clothes, it\'s a feeling.  We believe fashion is a powerful language, one that allows you to express your individuality and tell your story. Find pieces that ignite your spirit and make you feel like the most authentic version of yourself.'),
(7, 'Pet Care', '/images/categories/pet_care.jpg', 'Nurture the love between you and your pet. Explore our comprehensive pet care collection, featuring everything from food and treats to toys and accessories. Find the perfect essentials to keep your furry (or feathery) friend happy and healthy. ');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `Address` text NOT NULL,
  `zipcode` int(11) NOT NULL,
  `country` text NOT NULL,
  `city` text NOT NULL,
  `email` text NOT NULL,
  `products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`products`)),
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `phone_num` int(12) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `surname` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `orders`
--

INSERT INTO `orders` (`order_id`, `name`, `Address`, `zipcode`, `country`, `city`, `email`, `products`, `order_date`, `phone_num`, `total`, `surname`) VALUES
(66, 'Eren', 'Büyükbakkalköy, Maltepe Ünv. Marmara Eğitim Köyü, 34857 Maltepe/İstanbul', 34857, 'Turkey', 'Istanbul', 'uzgun_corap@gmail.com', '{\"24\":3,\"17\":3}', '2024-05-31 08:10:19', 588888888, 312014.00, 'Kızılırmak'),
(67, 'Cagla', 'Büyükbakkalköy, Maltepe Ünv. Marmara Eğitim Köyü, 34857 Maltepe/İstanbul', 34857, 'Turkey', 'Istanbul', 'cagla_karaytu@gmail.com', '{\"15\":2,\"19\":1,\"9\":3}', '2024-05-31 08:19:09', 507450565, 7420.00, 'Karaaytu'),
(68, 'Emre', 'Büyükbakkalköy, Maltepe Ünv. Marmara Eğitim Köyü, 34857 Maltepe/İstanbul', 34857, 'Turkey', 'Istanbul', 'emreolca@gmail.com', '{\"19\":1,\"14\":1,\"12\":1}', '2024-05-31 08:30:19', 599900909, 12288.00, 'Olca'),
(69, 'sdf', 'egwertwertwertwert', 234234, 'Turkey', 'Istanbul', 'sdlfgsd@gmail.com', '{\"12\":1}', '2024-05-31 08:33:34', 657666565, 11419.00, 'sdfg'),
(70, 'Fname ', 'Example Address', 876, 'Turkey', 'Istanbul', 'fname_sname@icloud.com', '{\"7\":4,\"24\":7}', '2024-06-02 10:54:15', 560678767, 328409.00, 'Surname'),
(71, 'book', 'book lover st', 977, 'Turkey', 'Istanbul', 'booklover@gmail.com', '{\"8\":4}', '2024-06-02 11:01:05', 777777777, 2978.80, 'lover'),
(72, 'wew', 'werwe', 345, 'werwer', 'wer', 'wewrwer', '{\"13\":4}', '2024-06-02 11:04:33', 45345345, 4015.60, 'ewe');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `id` int(32) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(32) NOT NULL,
  `img` text NOT NULL,
  `category_id` int(32) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `brand` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `quantity`, `img`, `category_id`, `date_added`, `brand`) VALUES
(7, 'Philips Kahve Makinesi', '                Marka : PHILIPS\r\nKapasite : 	1.2 Liters\r\nRenk : Siyah\r\nÜrün Boyutları : 23.8D x 26.8G x 35.8Y santimetre\r\nÖnemli Özellik : Sürahili\r\nBu ürün hakkında\r\n\r\nMenşe Ülke: Çin\r\nMakinede yıkanabilen parçalar\r\nÇıkarılabilir filtre tutucu\r\nEnerji tasarrufu ve güvenlik için 30 dakikadan sonra otomatik kapanma\r\nDilediğiniz zaman bir fincan kahve almanız için damlama önleyici özelliği\r\nKahve filtresi kağıdı ile kullanılmalıdır                ', 1599.00, 1996, '/images/products/kahve.png', 1, '2024-05-12 14:36:51', 'Philipss'),
(8, 'HBR\'S 10 Must Reads: The Essentials', '   Change is the one constant in business, and we must adapt or face obsolescence. Yet certain challenges never go away. That\'s what makes this book \"must read.\" These are the 10 seminal articles by management\'s most influential experts, on topics of perennial concern to ambitious managers and leaders hungry for inspiration--and ready to run with big ideas to accelerate their own and their companies\' success.\r\n   ', 739.70, 2993, '/images/categories/book.jpg', 4, '2024-05-12 18:23:44', 'Harvard Business Review'),
(9, 'La Roche-Posay Anthelios Dry Touch Spf 50+ Yağlı Ciltler İçin Güneş Koruyucu Yüz Kremi 50 ML', 'Yoğun güneş ışığına maruz kalan, alerjiye eğilimli, hassas veya güneşe karşı toleranssız normal, karma ve yağlı cilt\r\n\r\nÇok yüksek UVA/UVB koruması içerir\r\n\r\nMexoplex filtreleme sistemi ve yatıştırıcı antioksidan özellikli La Roche-Posay Termal Suyu sayesinde UVA ışınlarına karşı güçlendirilmiş SPF 50+ koruma içerir\r\n\r\nGünlük kullanıma uygundur', 599.00, 3997, '/images/products/sunscreen.jpg', 5, '2024-05-12 18:30:09', 'La Roche Posay'),
(10, 'Levi\'s Graphic Set-In Tişört Erkek', '100% pamuk\r\n\r\nGenç - yetişkin için uygundur\r\n\r\nBenzer renklerle bir arada ters çevirerek yıkayın ve kurutun; sıvı deterjan kullanmanız önerilir', 377.90, 3000, '/images/products/t-shirt.jpg', 6, '2024-05-12 18:36:55', 'Levi\'s'),
(11, 'Skechers Kadın D\'lites Jungle Adventure Modaya uygun spor ayakkabı', 'Malzeme Bileşimi :  Karışık\r\nTaban Malzemesi :  Sentetik\r\nMil Yüksekliği :  Ankle\r\nPlatform Yüksekliği :  1 inches \r\n\r\nHafif; 3,8 cm entegre topuk.\r\nEsnek taban', 3381.12, 3000, '/images/products/ayakkabı.jpg', 6, '2024-05-12 19:03:03', 'Skechers'),
(12, 'Kärcher VC 6 Ourfamily Dikey Elektrikli Süpürge', 'Teknik özellikler: HEPA 12 filtreli torbasız VC 6, 50 dakikaya kadar temizlik imkanı sunar. Pil seviyesinin kolay okunması için ünite üzerinde bir LED göstergesi vardır. Yalnızca 2,8 kg ağırlığındadır.\r\n\r\nKärcher VC 6 Cordless ourFamily kablosuz elektrikli süpürge tüm zeminlerdeki tozu, kırıntıları ve tüyleri temizler. Zemin başlığı entegre LED ışıklara sahiptir, bu nedenle karanlık köşelerde ve zayıf görüş koşullarında bile toz görülebilir.\r\n\r\nKutu İçeriği: Kutu İçeriği: VC 6 Cordless ourFamily dikey elektrikli süpürge, emiş hortumu, duvar desteği, zemin ve aralık başlığı, 2\'si 1 arada fırça, 21,6 V batarya ve şarj cihazı.', 11399.00, 3994, '/images/products/karcher.jpg', 1, '2024-05-12 19:06:12', 'Kärcher'),
(13, 'THE ORDINARY AHA 30% + BHA 2% PEELING SOLUSYONU 30ML', 'Ürün Hacmi : 	30 Mililitre\r\nÜrün Ağırlığı: 	28 Gram\r\nBirim Sayısı: 	30 ml\r\nBoyut/Ebat: Standart\r\nParça Numarası: 1\r\nModel Numarası: 1\r\nMarka: THE ORDINARY', 998.90, 3996, '/images/products/ordinary.jpg', 5, '2024-05-12 19:10:35', 'The Ordinary'),
(14, 'Sefiller - 2 Kitap Takım', 'Victor Hugo (1802-1885): Fransız edebiyatının gelmiş geçmiş en büyük yazarlarındandır. Şiirleri, oyunları ve romanları ile tanınır. Romantizm akımının Fransa\'daki temsilcisidir. Edebiyat alanındaki devasa başarılarının yanında politik hayatta da etkin bir rol üstlendi, bu nedenle sürgün cezasına çarptırıldı, cezasını tamamlamasına rağmen İmparatorluk yıkılana dek Fransa\'ya dönmedi. İlk kez 1862 yılında yayımlanan Sefiller yazarın Notre-Dame\'ın Kamburu ile \"din\", Deniz İşçileri ile \"doğa\" konularını işlediği roman üçlemesinin \"toplum\"u ele alan, en görkemli ayağıdır. Bu destansı roman Fransız toplumundan yola çıkarak, kozmolojik bir bakış ve eşsiz bir duyarlılıkla insanlığa ulaşır. Fantine\'in, Cosette\'in, Marius\'ün, Saint-Denis Sokağı barikatlarının, Paris\'in, Javert\'in ve Jean Valjean\'ın sefaletten sevgiye, felaketten iyiliğe ve karanlıktan aydınlığa uzanan hikayeleri Hasan Ali Yücel Klasikler Dizisi\'nin 250. kitabında okurlarla buluşuyor.', 174.40, 3999, '/images/products/sefiller.jpg', 4, '2024-05-12 19:16:46', 'Türkiye İş Bankası Kültür Yayınları'),
(15, 'Stanley Klasik Vakumlu Termos 1,9 lt Yeşil', 'Kamp alanı, şantiye veya hatta karavanda - bu termosun ikonik stili ve dayanıklılığı, her yere gitmeye hazır olduğu anlamına gelir. Stanley 1.4 lt termosun, çift duvarlı vakum yalıtımı, tüm içeceklerinizi ideal sıcaklıkta tutar ve içeceğinizi daha kolay dökmeniz için, çevir – dök tıpası vardır. Kullanışlı yalıtımlı kapak bir bardak görevi görür ve ayrıca kolay taşıma için katlanabilir bir taşıma kulpu vardır.\r\nStanley 1.4 lt termos,dayanıklı, sızdırma yapmayan, paslanmayan bu vakumlu çok kullanışlı termos, güzel, güneşli bir günde pikniğe çıkanlar ve maceracılar için mükemmel bir arkadaştır.\r\nStanley Termos Ürün Teknik Özellikleri\r\nHacim:1,4 lt\r\nAğırlık: 935 gr\r\nBoyutlar:9.9 x 12 x 35.8 cm\r\nYapı: Paslanmaz Çelik Gövde\r\nYapı: Çift Duvar Yalıtım\r\nBPA: İçermez\r\nSıcak: 40 Saat\r\nSoğuk 35 Saat\r\nBuzlu İçecekler:144 Saat', 2454.00, 3998, '/images/products/termos.jpg', 2, '2024-05-12 19:28:04', 'Stanley'),
(16, 'Decathlon Quechua 4 Kişilik Kamp Çadırı - 1 Odalı - Arpenaz 4.1', 'Kapasite:   Oda: 240 X 210 cm | Yüksek tavanlı yaşam alanı: brandalı zemin matıyla 5 m²\r\n\r\nTaşıma kolaylığı:   Dikdörtgen taşıma çantası | 60 X 24 X 24 cm | 35 litre | 10,2 kg\r\n\r\n\r\nÜRÜN KONSEPTİ VE TEKNOLOJİSİ\r\n\r\nÜRÜN BİLEŞİMİ:\r\nAna kumaş: 100.0% Polietilen Tereftalat\r\nDirek: 100.0% Cam - Elyaf\r\nOda: 100.0% Polietilen Tereftalat\r\nYer matı: 100.0% Yüksek Yoğunluklu Polietilen\r\nTaşıma çantası: 100.0% Polietilen Tereftalat\r\n\r\nKULLANICI TALİMATLARI:   Dış mekanda uzun süre bırakmaya uygun değildir.', 7590.00, 4000, '/images/products/cadir.jpg', 2, '2024-05-12 19:33:13', 'Decathlon'),
(17, 'Apple iPhone 15 (512 GB) - Pembe', 'DYNAMIC ISLAND ŞİMDİ IPHONE 15’TE — Uyarıları ve Canlı Etkinlikler’i hop diye gözünüzün önüne getiren Dynamic Island sayesinde başka bir şeyle ilgilenirken olan biteni kaçırmıyorsunuz. Kimin aradığını görmek, sizi almaya gelen aracı takip etmek, uçuş durumunuzu öğrenmek gibi birçok şeyi yapabiliyorsunuz.\r\n\r\nYENİLİKÇİ TASARIM — iPhone 15 renkle işlenmiş dayanıklı cam ve alüminyum tasarımla sunuluyor. Suya, sıçramalara ve toza dayanıklı. Tüm akıllı telefon camlarından daha sağlam bir materyal olan Ceramic Shield ön yüzeye sahip. 6.1 inç Super Retina XDR ekran iPhone 14’e kıyasla güneşte iki kata kadar daha aydınlık görünüyor.', 57999.00, 3995, '/images/products/iphone.jpg', 1, '2024-05-12 19:39:53', 'Apple'),
(18, 'Dove Ultra Care Saç Bakım Şampuanı Yoğun Onarıcı Yıpranmış Saçlar İçin 400 ml', 'Bio-Restore Kompleksi ile saça komple bakım yapar\r\n\r\nİçeriğindeki fiberaktifler saçı besler\r\n\r\nGünlük etkilerden kaynaklı yıpranmayı engeller\r\n\r\nYıpranmayı %98’e kadar önler, saçı yumuşatır ve saça parlaklık verir (Koparak dökülmelere karşı, kremsiz şampuanla karşılaştırıldığında)\r\n\r\nDove ürünlerinin hayvanlar üzerinde denenmediği PETA tarafından onaylanmıştır', 69.95, 4000, '/images/products/dove.jpg', 5, '2024-05-12 19:44:38', 'Dove'),
(19, 'Hello Paty Yetişkin Köpek Dana Etli Konserve Yaş Mama 24 Adet', '% 70 ETLI %10 PROTEINLI KONSERVE YAŞ MAMA İçermiş olduğu yüksek derecede sindirebilir taze hayvansal protein hayvanlarınızın ideal kilosunda kalması sağlar. Hayvansal protein olarak dana eti kullanılmıştır. Dengeli kalsiyum - fosfor oranı ile sağlıklı iskelet yapısını ve gelişimini sağlar. İçermiş olduğu vitamin ve mineraller sayesinde bağışıklık sistemini güçlendirir. Kendine has doğal aroması ve lezzeti sayesinde iştahla yenmesini sağlar. Ethoxyquin, BHA ve BHT içermez. Yapay kimyasal içermez. Hello Paty ürünlerinde AAFCO kedi maması beslenme standartlarını gözetmektedir. Yüksek protein ve lif içerir. D, E Vitamini. Ca/P oranı 1:1 Yetişkin bi kedi için 1 kutu konserve 2-3 öğüne bölerek 1 günde yedirilmesi önerilir.', 695.00, 2496, '/images/products/kopek_mamasi.jpg', 7, '2024-05-23 12:06:48', 'Hello Paty'),
(24, 'Ipad Pro M4', '  En gelişmiş teknolojiye sahip en üst düzey iPad deneyimi. 13 inç veya 11 inç Ultra Retina XDR ekran2 ProMotion teknolojisi P3 geniş renk yelpazesi True Tone Yansıma önleyici kaplama 1 TB ve 2 TB modellerde nano‑texture cam seçeneği  ', 45999.00, 986, '/images/categories/ipad-compare-header-pro-202405.jpeg', 1, '2024-05-30 14:27:57', 'Apple');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_username` (`admin_username`) USING HASH,
  ADD KEY `admin_status` (`admin_status`);

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Tablo için indeksler `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Tablo için AUTO_INCREMENT değeri `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Tablo için AUTO_INCREMENT değeri `products`
--
ALTER TABLE `products`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
