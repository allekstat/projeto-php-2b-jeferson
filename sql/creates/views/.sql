create view view_custo_peca_madeira as
(
    select md.nome_madeira as MADEIRA,
        pc.nome_peca,
        pd.quantidade_pecas_producao,
        ch.largura_chapa * ch.altura_chapa * ch.espessura_chapa as VOLUME_CHAPA,
        pc.largura_peca * pc.altura_peca * pc.espessura_peca * pd.quantidade_pecas_producao as VOLUME_TOTAL_PECAS,
        round(ch.valor_chapa / (ch.largura_chapa * ch.altura_chapa * ch.espessura_chapa)) as PRECO,
        round((pc.largura_peca * pc.altura_peca * pc.espessura_peca * pd.quantidade_pecas_producao) * (ch.valor_chapa / (ch.largura_chapa * ch.altura_chapa * ch.espessura_chapa))) as CUSTO
    from producoes pd
        inner join pecas pc on pc.id_peca = pd.peca_producao
        inner join chapas ch on ch.id_chapa = pd.chapa_producao
        inner join madeiras md on md.id_madeira = ch.madeira_chapa
);
