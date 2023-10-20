BEGIN;

CREATE TABLE public.usuarios(
login text primary key,
token text not null
);

CREATE TABLE public.produtos(
id serial primary key,
nome text not null,
preco decimal(10,2) not null,
descricao text not null,
img text not null,
usuarios_login text not null,
criado_em timestamp default now()
);

ALTER TABLE public.produtos
    ADD FOREIGN KEY (usuarios_login)
    REFERENCES public.usuarios (login)
    NOT VALID;
	
END;