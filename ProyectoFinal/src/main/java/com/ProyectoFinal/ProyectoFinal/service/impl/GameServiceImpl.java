package com.ProyectoFinal.ProyectoFinal.service.impl;

import com.ProyectoFinal.ProyectoFinal.domain.Game;
import java.util.List;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;
import com.ProyectoFinal.ProyectoFinal.service.GameService;
import com.ProyectoFinal.ProyectoFinal.dao.GameDao;
@Service
public class GameServiceImpl implements GameService {
    @Autowired
    private GameDao gameDao;
    
    
    @Transactional(readOnly=true)
    @Override
    public List<Game> getGames() {
        var lista=gameDao.findAll();
        return lista;
    }
    
    @Transactional(readOnly=true)
    @Override
    public List<Game> getGamesByNameContaining(String nombre) {
        var lista=gameDao.findByNameContaining(nombre);
        return lista;
    }
    
    @Transactional(readOnly=true)
    @Override
    public Game getGame(long id) {
        var game=gameDao.findById(id).orElse(null);
        return game;
    }
    
    @Transactional
    @Override
    public Game save(Game game) {
       return gameDao.save(game);
    }
    
    @Transactional
    @Override
    public void delete(Game game) {
        gameDao.delete(game);
    }
    
}
