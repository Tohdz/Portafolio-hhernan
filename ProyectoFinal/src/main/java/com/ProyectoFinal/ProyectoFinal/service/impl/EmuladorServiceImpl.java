
package com.ProyectoFinal.ProyectoFinal.service.impl;

import com.ProyectoFinal.ProyectoFinal.dao.EmuladorDao;
import java.util.List;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;
import com.ProyectoFinal.ProyectoFinal.domain.Emulador;
import com.ProyectoFinal.ProyectoFinal.service.EmuladorService;
import static jakarta.persistence.GenerationType.UUID;
import java.nio.file.Files;
import java.nio.file.Paths;
import org.springframework.data.jpa.domain.JpaSort.Path;
import org.springframework.web.multipart.MultipartFile;

@Service
public class EmuladorServiceImpl implements EmuladorService{
    @Autowired
    private EmuladorDao emuladorDao;
    
    
    @Transactional(readOnly=true)
    @Override
    public List<Emulador> getEmuladores() {
        var lista=emuladorDao.findAll();
        return lista;
    }

    @Override
    public Emulador getEmulador(Emulador emulador) {
        return emuladorDao.findById(emulador.getId()).orElse(null);
    }

    @Override
    @Transactional
    public void save(Emulador emulador) {
        emuladorDao.save(emulador);
    }

    @Override
    @Transactional
    public void delete(Emulador emulador) {
        emuladorDao.delete(emulador);
    }
}
