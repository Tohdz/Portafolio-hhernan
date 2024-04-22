package com.ProyectoFinal.ProyectoFinal.service;

import com.ProyectoFinal.ProyectoFinal.domain.Contacto;
import java.util.List;
import org.springframework.web.bind.annotation.RequestParam;

public interface ContactoService {
    // Se obtiene un listado de libros en un List
    public List<Contacto> getContactos();
    public Contacto getContacto(Contacto contacto);
    public void save(Contacto contacto);
    public void delete(Contacto contacto);
}
