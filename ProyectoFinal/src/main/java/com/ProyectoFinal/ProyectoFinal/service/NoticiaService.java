package com.ProyectoFinal.ProyectoFinal.service;

import com.ProyectoFinal.ProyectoFinal.domain.Noticia;
import java.util.List;
import org.springframework.web.multipart.MultipartFile;

public interface NoticiaService {
    // Se obtiene un listado de libros en un List
    public List<Noticia> getNoticias();
    public Noticia getNoticia(Noticia noticia);
    public void save(Noticia noticia);
    public void delete(Noticia noticia);
}