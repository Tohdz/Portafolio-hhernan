package com.ProyectoFinal.ProyectoFinal.dao;

import com.ProyectoFinal.ProyectoFinal.domain.Game;
import java.util.List;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.jpa.repository.JpaRepository;

public interface GameDao extends JpaRepository <Game,Long>{
    @Query("SELECT g FROM Game g WHERE LOWER(g.name) LIKE LOWER(CONCAT('%', :name, '%'))")
    List<Game> findByNameContaining(String name);
}

