package com.ProyectoFinal.ProyectoFinal.service;

import com.ProyectoFinal.ProyectoFinal.domain.Game;
import java.util.List;

public interface GameService {
    // Se obtiene un listado de libros en un List
    public List<Game> getGames();
    public List<Game> getGamesByNameContaining(String name);
    public Game getGame(long id);
    public Game save(Game game);
    public void delete(Game game);
}
