/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tamedia_listings` (
    `record.adId` int NOT NULL,
    `record.saleType` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `record.source` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `record.language` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `record.originalPropertyCategory` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `record.propertyCategory` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `record.paymentInterval` varchar(28) DEFAULT NULL,
    `record.sellerType` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `record.price` float DEFAULT NULL,
    `record.netPrice` float DEFAULT NULL,
    `record.publishedDate` datetime DEFAULT NULL,
    `record.propertyLocation.region` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `record.propertyLocation.canton` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `record.propertyLocation.cantonCode` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `record.propertyLocation.country` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `record.propertyLocation.countryCode` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `record.propertyLocation.city` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `record.propertyLocation.street` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `record.propertyLocation.zip` int DEFAULT NULL,
    `type` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `record.url` varchar(256) DEFAULT NULL,
    `record.company.logo` varchar(256) DEFAULT NULL,
    `record.company.name` varchar(256) DEFAULT NULL,
    `record.ownObjectUrl` varchar(256) DEFAULT NULL,
    `record.seller.name` varchar(256) DEFAULT NULL,
    `record.seller.image` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;