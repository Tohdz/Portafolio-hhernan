package com.ProyectoFinal.ProyectoFinal.service;

import com.ProyectoFinal.ProyectoFinal.domain.Tutorial;
import java.util.List;

public interface TutorialService {
    // Se obtiene un listado de libros en un List
    public List<Tutorial> getTutoriales();
    public Tutorial getTutorial(Tutorial tutorial);
    public void save(Tutorial tutorial);
    public void delete(Tutorial tutorial);
}