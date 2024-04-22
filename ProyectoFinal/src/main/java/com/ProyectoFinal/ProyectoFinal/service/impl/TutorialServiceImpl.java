/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.ProyectoFinal.ProyectoFinal.service.impl;

import com.ProyectoFinal.ProyectoFinal.dao.TutorialDao;
import com.ProyectoFinal.ProyectoFinal.domain.Tutorial;
import com.ProyectoFinal.ProyectoFinal.service.TutorialService;
import java.util.List;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

/**
 *
 * @author ulgcu
 */
   @Service
public class TutorialServiceImpl implements TutorialService {

    @Autowired
    private TutorialDao tutorialDao;
    
    
    @Transactional(readOnly=true)
    @Override
    public List<Tutorial> getTutoriales() {
        var lista=tutorialDao.findAll();
        return lista;
    }

    @Override
    public Tutorial getTutorial(Tutorial tutorial) {
        return tutorialDao.findById(tutorial.getId()).orElse(null);
    }

    @Override
    @Transactional
    public void save(Tutorial tutorial) {
        tutorialDao.save(tutorial);
    }

    @Override
    @Transactional
    public void delete(Tutorial tutorial) {
        tutorialDao.delete(tutorial);
    }
}
    

