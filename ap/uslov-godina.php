					<tr>
						<th scope="row"><?php echo $row["id"]; ?></th>
						<td>
							<?php
								$id = $row['id_korisnika']; 
								$sql = "SELECT ime, prezime FROM users WHERE id = $id";
								
								$res = mysqli_query($conn, $sql) or trigger_error(mysql_error());

								if (mysqli_num_rows($res) == 1) {
									$row2 = mysqli_fetch_assoc($res);
									echo $row2['ime'] . " " . $row2['prezime'];
								}
							?>
						</td>
						<td>
							<?php
								$id = $row['id_radnika']; 
								$sql = "SELECT ime, prezime FROM users WHERE id = $id";
								
								$res = mysqli_query($conn, $sql) or trigger_error(mysql_error());

								if (mysqli_num_rows($res) == 1) {
									$row2 = mysqli_fetch_assoc($res);
									echo $row2['ime'] . " " . $row2['prezime'];
								}
							?>
						</td>
						<td><?php echo $row["opis_aktivnosti"]; ?></td>
						<td><?php echo $row["komentar"]; ?></td>
						<td><?php if ($row["zavrseno"] == 1) { echo "Da"; } else { echo "Ne"; } ?></td>
						<td><?php echo $row["datum_unosa"]; ?></td>
						<td><?php echo $row["datum_zavrsenja"]; ?></td>
						<td><a href="images/racuni/<?php echo $row['slika']; ?>">Slika</a></td>
					</tr>