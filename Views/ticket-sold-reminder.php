<div class="container">
    <h2 class="mb-4 mt-4 text-white">Tickets vendidos y remanentes</h2>
					<div class="filter-search">
            <div class="col-lg-3 pl-0">
                 <div class="form-group">
                      <input type="text" name="name" value="" class="form-control" placeholder="Filtrar por..." required>
                      <button type="submit" name="button" value="" class="btn btn-danger">Filtrar</button>
                 </div>
            </div>
					</div>
					<div class="filter-options text-white">
						<!--<label>Filter by:</label>
						<input type="radio" name="filter" id="input-cinema" value="cinema" checked> Cine
						<input type="radio" name="filter" id="input-movie" value="movie"> Pelicula
						<input type="radio" name="filter" id="input-date" value="date"> Dia-->
					</div>

        <table class="table bg-light-alpha">
                <thead>
                    <tr>
                        <th>Id Show</th>
                        <th>Cine</th>
                        <th>Sala</th>
                        <th>Dia</th>
                        <th>Hora</th>
                        <th>Pelicula</th>
                        <th>Tickets vendidos</th>
                        <th>Remanentes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tickets as $ticket): ?>
                        <tr>
                            <td><?php $ticket->getShow()->getIdShow(); ?></td>
                            <td><?php $ticket->getShow()->getMovieTheater()->getCinema()->getName(); ?></td>
                            <td><?php $ticket->getShow()->getMovieTheater()->getName(); ?></td>
                            <td><?php $ticket->getShow()->getDay(); ?></td>
                            <td><?php $ticket->getShow()->getHour(); ?></td>
                            <td><?php $ticket->getShow()->getMovie()->getTitle(); ?></td>
                            <td><?php $this->getTicketsSold($ticket->getShow()->getIdShow()); ?></td>
                            <td><?php $this->getTickesRemainder($ticket->getShow()->getIdShow()); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
         </table>
         <h3 class="mt-5 text-white text-center">Informe de ventas</h3>
         <table class="table bg-light-alpha">
                 <thead>
                     <tr>
                         <th>Cine</th>
                         <th>Tickets vendidos</th>
                         <th>Remanentes</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php foreach ($tickets as $ticket): ?>
                         <tr>
                             <td><?php $ticket->getShow()->getMovieTheater()->getCinema()->getName(); ?></td>
                             <td><?php $this->getTicketsSold($ticket->getShow()->getIdShow()); ?></td>
                             <td><?php $this->getTickesRemainder($ticket->getShow()->getIdShow()); ?></td>
                         </tr>
                     <?php endforeach; ?>
                 </tbody>
          </table>
          <table class="table bg-light-alpha">
                  <thead>
                      <tr>
                          <th>Pelicula</th>
                          <th>Tickets vendidos</th>
                          <th>Remanentes</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($tickets as $ticket): ?>
                          <tr>
                              <td><?php $ticket->getShow()->getMovieTheater()->getName(); ?></td>
                              <td><?php $this->getTicketsSold($ticket->getShow()->getIdShow()); ?></td>
                              <td><?php $this->getTickesRemainder($ticket->getShow()->getIdShow()); ?></td>
                          </tr>
                      <?php endforeach; ?>
                  </tbody>
           </table>
    </div>
