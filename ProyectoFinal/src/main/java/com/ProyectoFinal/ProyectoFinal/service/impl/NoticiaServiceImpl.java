package com.ProyectoFinal.ProyectoFinal.service.impl;

import com.ProyectoFinal.ProyectoFinal.dao.NoticiaDao;
import java.util.List;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;
import com.ProyectoFinal.ProyectoFinal.domain.Noticia;
import com.ProyectoFinal.ProyectoFinal.service.NoticiaService;
import static jakarta.persistence.GenerationType.UUID;
import java.nio.file.Files;
import java.nio.file.Paths;
import org.springframework.data.jpa.domain.JpaSort.Path;
import org.springframework.web.multipart.MultipartFile;

@Service
public class NoticiaServiceImpl implements NoticiaService {
    @Autowired
    private NoticiaDao noticiaDao;
    
    
    @Transactional(readOnly=true)
    @Override
    public List<Noticia> getNoticias() {
        var lista=noticiaDao.findAll();
        return lista;
    }

    @Override
    public Noticia getNoticia(Noticia noticia) {
        return noticiaDao.findById(noticia.getId()).orElse(null);
    }

    @Override
    @Transactional
    public void save(Noticia noticia) {
        noticiaDao.save(noticia);
    }

    @Override
    @Transactional
    public void delete(Noticia noticia) {
        noticiaDao.delete(noticia);
    }
}