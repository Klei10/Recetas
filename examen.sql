-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 25, 2017 at 06:20 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `examen`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_recipes`
--

CREATE TABLE `tb_recipes` (
  `id_recipe` int(10) NOT NULL,
  `recipe_name` text NOT NULL,
  `recipe_prep_time` text NOT NULL,
  `recipe_cook_time` text NOT NULL,
  `recipe_serves` text NOT NULL,
  `recipe_description` text NOT NULL,
  `recipe_image` text NOT NULL,
  `id_category` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_recipes`
--

INSERT INTO `tb_recipes` (`id_recipe`, `recipe_name`, `recipe_prep_time`, `recipe_cook_time`, `recipe_serves`, `recipe_description`, `recipe_image`, `id_category`) VALUES
(1, 'Lemon chicken', 'Less than 30 mins', 'less than 10 mins', 'Serves 1', 'Whip up a lemon butter sauce in next to no time to make something special of simple fried chicken breasts', 'lemon-chicken.jpg', 1),
(2, 'Pasta with mushroom sauce', 'less than 30 mins', 'less than 10 mins', 'Serves 1', 'Pasta with portobello mushrooms cooked with fresh parsely, white wine, garlic and olive oil, what are you waiting for?', 'pasta-with-mushroom-sauce.jpg', 2),
(3, 'Special fried rice', 'Less than 30 mins', '10 to 30 mins', 'Serves 1', 'James Martin’s version of this takeaway favourite is fast, easy, uses up your leftovers and goes easy on the washing up.', 'special-fried-rice.jpg', 3),
(4, 'Cheese and ham omelette', 'less than 30 mins', 'less than 10 mins', 'Serves 1', 'Try this classic omelette for brunch or serve with lots of green salad for a quick and satisfying dinner.', 'cheese-and-ham-omelette.jpg', 7),
(5, 'Beef tortilla wraps', 'less than 30 mins', '10 to 30 mins', 'Serves 1', 'Whip up a quick beef wrap with zesty guacamole for a tasty supper. Making your own guacamole is super easy and a handy thing to prepare for an evening with friends.', 'beef-tortilla-wraps.jpg', 1),
(6, 'Beef steak for one', 'less than 30 mins', 'less than 10 mins', 'Serves 1', 'Cooking for yourself does not have to be a chore, this pepper-crusted juicy steak is cooked in ten minutes.', 'beef-steak-for-one.jpg', 1),
(11, 'Lamb burgers with mint mayo and tomato relish', '30 mins to 1 hour', '30 mins to 1 hour', 'Serves 8', 'These tasty burgers are perfect as an easy mid-week meal, or for a barbecue. In fact, the tomato relish goes well with any grilled meat, from steaks and chops to bangers.', 'lamb-burgers.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_recipe_category`
--

CREATE TABLE `tb_recipe_category` (
  `id_category` int(10) NOT NULL,
  `category_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_recipe_category`
--

INSERT INTO `tb_recipe_category` (`id_category`, `category_name`) VALUES
(1, 'Carnes'),
(2, 'Pastas'),
(3, 'Sopas'),
(4, 'Arroces'),
(5, 'Almuerzos'),
(6, 'Cenas'),
(7, 'Desayunos');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_recipes`
--
ALTER TABLE `tb_recipes`
  ADD PRIMARY KEY (`id_recipe`);

--
-- Indexes for table `tb_recipe_category`
--
ALTER TABLE `tb_recipe_category`
  ADD PRIMARY KEY (`id_category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_recipes`
--
ALTER TABLE `tb_recipes`
  MODIFY `id_recipe` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tb_recipe_category`
--
ALTER TABLE `tb_recipe_category`
  MODIFY `id_category` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
