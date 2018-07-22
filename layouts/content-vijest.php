<?php 

include 'ap/db_connect.php';

if (isset($_GET['id'])) {
	$id = escape($_GET['id']);

	$sql = "SELECT * FROM vijesti ";
	$sql .= "WHERE id = '{$id}'";

	$result = mysqli_query($conn, $sql);

	if ($result && mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_assoc($result);

		$naslov = $row['naslov'];
		$slika = "images/vijesti/" . $row['slika'];
		$datum = date('d M Y', strtotime($row['datum_objave']));
		$autor = $row['autor'];
		$tekst = $row['tekst'];
		$tekst = bb($tekst);
	}

	?>

	<div class="bg-white py-5">
		<div class="container">
			<h1 class="display-3"><?php echo $naslov; ?></h1>
			<p><?php echo $datum . " " . $autor; ?></p>

	<form name="my_form"> 
	    <textarea id="mytextarea"></textarea><br /> 
	    <input type="button" value="Slika" class="btn btn-outline-dark" onclick="formatText ('img');" /> 
	    <input type="button" value="Podebljano" class="btn btn-outline-dark" onclick="formatText ('b');" /> 
	    <input type="button" value="Podvučeno" class="btn btn-outline-dark" onclick="formatText ('u');" /> 
	    <input type="button" value="Italic" class="btn btn-outline-dark" onclick="formatText ('i');" /> 
	    <input type="button" value="Link" class="btn btn-outline-dark" onclick="formatText ('url');" /> 
	</form>
		</div>
	    <img class="w-100 carousel-img py-5" src="<?php echo $slika; ?>" alt="Naslovna slika">
		<div class="container text-justify">
			<p><?php echo $tekst; ?></p>
			<!--
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia vel delectus aut odio cum autem, adipisci nihil inventore fugit sint asperiores repellendus laborum temporibus earum, ad. Temporibus repudiandae maiores sed ut perferendis fugiat praesentium distinctio beatae doloremque adipisci consequuntur sapiente, molestias eveniet? Eaque nemo officiis nihil sed dolorem numquam perspiciatis eius neque praesentium. Perspiciatis quas qui aspernatur obcaecati fugit reiciendis voluptate deserunt assumenda commodi magnam suscipit, eius repellendus minima iure reprehenderit saepe nostrum cupiditate voluptas dolor consequatur, aliquid doloremque ipsa. Excepturi ipsam blanditiis sint amet cumque doloremque assumenda, nobis aspernatur, nisi aliquid voluptate provident id iure, placeat aut ipsa non hic ea numquam. Illum similique vel, vitae quis sint. Laudantium commodi pariatur tempora eos ea? Optio reiciendis aliquam quasi consequuntur maxime totam autem est libero rem nisi. Cum quaerat dolor expedita aliquam fugiat suscipit! Fugiat illo molestias officiis sapiente corporis adipisci debitis omnis dignissimos, sunt, dolores facere, dolorem sint consequatur. Voluptatum error quod mollitia fugit ipsam asperiores nulla magnam eveniet sequi officiis, beatae animi, eius rerum repudiandae id voluptatibus commodi necessitatibus adipisci dolorem dolor temporibus? Omnis sint sunt ea, quibusdam eligendi? Deleniti, optio atque ex odio! Ullam libero praesentium nobis, at recusandae, quas fugiat cum voluptates optio ratione maxime, consequatur quam. Neque nulla, explicabo tempore architecto labore similique voluptate culpa ut, aspernatur quod nihil doloremque sequi iusto quia. Consectetur eveniet, ullam corporis voluptatum commodi amet recusandae. Aperiam incidunt blanditiis eveniet reprehenderit, consequuntur voluptate, nostrum mollitia ipsum repellendus maiores? Fuga neque, quis officia. Ab esse totam non corporis quibusdam dolor error ullam voluptatum quod odio facilis sapiente ad hic repellat repudiandae libero, suscipit rerum quam facere expedita. Nesciunt explicabo soluta, libero, odio consequatur excepturi recusandae ipsam hic provident officiis dolorum aliquid enim delectus tempore inventore accusamus fugiat! Quia tempore eveniet dolore, a dolorem animi, consectetur illo maiores blanditiis doloremque laborum perspiciatis ipsam ad. Odit minima, ut obcaecati magni? Tempora iure voluptas quas alias molestias. Iure animi cum, a provident culpa iusto id suscipit explicabo pariatur? Quis ratione, excepturi velit repellendus quas officiis, expedita. Facilis, quam velit voluptatum consectetur excepturi consequatur aperiam. Inventore sint odit, temporibus blanditiis ipsum iste officia reiciendis fugit minima, possimus tenetur tempora! Enim, quas accusamus, laboriosam fugiat saepe, cum distinctio esse quisquam in nesciunt eaque commodi eum quasi consequuntur earum aperiam necessitatibus cumque, sequi libero ea. Doloremque ut quisquam autem, suscipit, nisi eligendi harum aliquid iusto! Quis repellat eligendi labore. Quos natus debitis rerum exercitationem iure fuga deserunt quidem, voluptas quae odit illum optio cupiditate repellat quasi suscipit voluptatem saepe doloribus tenetur eos maiores ipsa! Impedit quas consectetur voluptate. Facilis deserunt atque culpa quos optio, enim dolorem eaque eius autem cumque. Quidem officiis officia obcaecati molestiae facilis ipsa laborum blanditiis quod! Eligendi ipsum quae praesentium illo ut aut quod accusamus vero, blanditiis eum nostrum vel culpa harum ducimus laboriosam perspiciatis dolores cupiditate recusandae similique pariatur. Excepturi beatae, sequi, repellat placeat ratione laborum tempore assumenda inventore ex debitis esse quis. Cumque ipsa labore accusamus qui quia repellendus voluptate distinctio fuga animi esse ut delectus ullam est, eveniet voluptates perspiciatis.</p>
			<img class="w-100 py-5" src="images/elder2.jpg" alt="">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere culpa beatae nesciunt praesentium? Doloremque quasi sed adipisci molestiae commodi voluptatibus nostrum delectus natus alias quisquam. Consequatur, cupiditate velit veritatis ea sequi soluta eum! Rem deleniti suscipit eligendi distinctio quia, voluptas sapiente mollitia doloremque. Dolorum, sapiente facere unde quibusdam a, cumque quia corporis consequuntur ea qui culpa numquam dolorem neque. Vero eum suscipit praesentium quod nisi obcaecati, voluptatem itaque consectetur officia minus eos harum nesciunt illo animi iusto qui nihil voluptates veniam! Placeat porro adipisci temporibus libero sunt soluta commodi ullam! Voluptatem illum maiores non optio sint repellat adipisci officiis, perspiciatis eum libero cumque, veritatis rem! Animi, earum! Quibusdam voluptate, a, commodi voluptatibus, illo ullam, consequuntur impedit saepe doloremque quisquam alias quis! Sit suscipit dolor qui, quidem fuga excepturi blanditiis minima. Dolores magni minima qui quisquam, inventore sequi quas culpa. Placeat expedita magni eos voluptatum, perspiciatis, error iste beatae exercitationem. Soluta dolorem corrupti culpa, quas laudantium est repellendus alias. Doloremque nostrum incidunt assumenda odit eligendi vero architecto? Non, eveniet, veritatis. Aperiam odit recusandae possimus optio quod minima sit eaque similique adipisci veritatis fuga, accusamus neque nesciunt nobis dicta, aliquid provident pariatur. Nostrum iusto esse sunt quis rerum veritatis! Neque aperiam, sed.</p>
			!-->
		</div>
	</div>

<?php

} else {
	header('Location: index.php');
	die();
}

?>