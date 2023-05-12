<table class="table table-striped table-bordered mt-3">
                                <thead>
                                    <tr class="text-center sorting">
                                        <th><strong>Date et Heure</strong></th>
                                        <th><strong>Niveau</strong></th>
                                        <th><strong>Salle</strong></th>
                                        <th><strong>Cours</strong></th>
                                        <th><strong>professeurs</strong></th>
                                    </tr>
                                </thead>
                                <tbody id="table">
                                    <?php 
                                        while($rows = mysqli_fetch_assoc($result)){
                                   ?>
                                    <tr class="emplo">
                                        <td>
                                            <?=$rows['date']?>
                                        </td>
                                        <td>
                                            <?=$rows['niveau']?>
                                        </td>
                                        <td>
                                            <?=$rows['design']?>
                                        </td>
                                        <td>
                                            <?=$rows['cours']?>
                                        </td>
                                        <td>
                                            <?=$rows['nom']?>
                                            <?=$rows['prenom']?>
                                        </td>
                                    </tr>
                                    <?php 
									}
									?>

                                </tbody>
                            </table>